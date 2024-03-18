<?php

namespace App\Http\Livewire\Import;

use App\Imports\ImportExcel;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportData extends Component
{
    use WithFileUploads;

    public $file;

    public function render(): Renderable
    {
        return view('livewire.import.import-data');
    }

    public function submit(): void
    {
        $this->validate([
            'file' => 'file:xlsx',
        ]);

        Excel::import(new ImportExcel, $this->file->store('excel'));

        $this->alertSuccess( 'success','Excel Procesado');

    }

    public function alertSuccess( $type, $message ): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
