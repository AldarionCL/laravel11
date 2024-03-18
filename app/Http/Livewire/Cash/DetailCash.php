<?php

namespace App\Http\Livewire\Cash;

use App\Exports\CashExport;
use App\Http\Utils\ProcessCash;
use App\Http\Utils\ProcessCashItemsRejected;
use App\Models\Cash\Cash;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DetailCash extends Component
{
    public $cash;
    public array $cashDetailsIds = [];
    public $message;

    public function mount(Cash $cash): void
    {
        $this->cash = $cash;
    }

    public function render(): Renderable
    {
        return view('livewire.cash.detail-cash', [
            'cash' => $this->cash->load(['cashDetails' => function ($query) {
                return $query->where('state', 1);
            }], 'cashierApprovals.user:ID,Nombre,active')
        ]);
    }

    public function submit(): void
    {
//        $this->authorize( 'update', $this->cash );

        $this->validate(
            [
                'message' => Rule::requiredIf( !empty( $this->cashDetailsIds ) )
            ],
            [
                'message.required_if' => 'Este campo es obligatorio, en caso de rechazo de items de la Rendición',
            ]
        );

        $process = new ProcessCash( $this->cash, 'passed' );
        $response = $process->states();

        if ( !empty( $this->cashDetailsIds ) ) {
            new ProcessCashItemsRejected( $this->cash, $this->message, $this->cashDetailsIds );
            $this->cash->cashDetails->whereIn( 'id', $this->cashDetailsIds )->toQuery()->update(['state' => 0]);
        }

        $this->alertSuccess( $response['type'], $response['message'] );

        $this->cash->refresh();
    }

    public function decline(): void
    {
        $this->validate(
            [
                'message' => 'required|max:5000',
            ],
            [
                'message.required' => 'Este campo es obligatorio, en caso de rechazo de Rendición',
                'message.max' => 'El campo puede tener un maximo de 5000 caracteres',
            ]
        );

        $this->cash->comment = $this->message;

        $process = new ProcessCash( $this->cash, 'refused' );
        $response = $process->states();

        $this->alertSuccess( $response['type'], $response['message'] );
    }

    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new CashExport($this->cash->id), 'rendicion-de-caja-'.$this->cash->id.'.xlsx');
    }
    public function alertSuccess( $type, $message ): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function reject($id): void
    {
        if ( !in_array($id, $this->cashDetailsIds, true)) {
            array_push($this->cashDetailsIds, $id);
        }
    }
}
