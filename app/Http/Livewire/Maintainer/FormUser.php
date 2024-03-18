<?php

namespace App\Http\Livewire\Maintainer;

use App\Models\Roma\Position;
use App\Models\Roma\Profile;
use App\Models\User;
use App\Models\UserDetail;
use App\Rules\RutUniqueUserTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormUser extends Component
{
    public User $user;

    public function mount(): void
    {
        $this->user = new User();
    }

    public function rules(): array
    {
        return [
            'user.Nombre' => [ 'required' ],
            'user.Email' => [ 'required', 'email' ],
            'user.Rut' => [ 'required', 'cl_rut', new RutUniqueUserTable ],
            'user.TelefonoOficina' => [ 'numeric' ],
            'user.Celular' => [ 'required', 'numeric'],
            'user.PerfilID' => [ 'required', 'exists:MA_Perfiles,ID' ],
            'user.CargoID' => [ 'required', 'exists:MA_Cargos,ID' ],
            'user.DetalleID' => [ 'required', 'exists:MA_UsuariosDetalles,ID',]
        ];
    }

    protected $messages = [
        'user.Nombre.required' => 'Este campo es obligatorio',
        'user.Email.required' => 'Este campo es obligatorio',
        'user.Email.email' => 'Debe ser una dirección de correo valida',
        'user.Rut.required' => 'Este campo es obligatorio',
        'user.Rut.cl_rut' => 'Debe ser un RUT valido',
        'user.TelefonoOficina.numeric' => 'Debe ingresar solo números',
        'user.Celular.required' => 'Este campo es obligatorio',
        'user.Celular.numeric' => 'Debe ingresar solo numeros',
        'user.PerfilID.required' => 'Este campo es obligatorio',
        'user.PerfilID.exists' => 'El valor no corresponde, favor validar',
        'user.CargoID.required' => 'El campo es obligatorio',
        'user.CargoID.exists' => 'El valor no corresponde, favor validar',
        'user.DetalleID.required' => 'Este campo es obligatorio',
        'user.DetalleID.exists' => 'El valor no corresponde, favor validar'
    ];

    public function render(): Renderable
    {
        return view('livewire.maintainer.form-user', [
            'profile' => Profile::select('Perfil', 'ID')->orderBy('Perfil', 'ASC')->get()->toArray(),
            'position' => Position::select('Cargo', 'ID')->orderBy('Cargo', 'ASC')->get()->toArray(),
            'detail' => UserDetail::select('Detalle', 'ID')->orderBy('Detalle', 'ASC')->get()->toArray(),
        ]);
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction( function () {
            $this->user->FechaCreacion = date('Y-m-d ');
            $this->user->EventoCreacionID = 129;
            $this->user->UsuarioCreacionID = auth()->user()->ID;
            $this->user->Disponible = 1;
            $this->user->Activo = 1;

            $this->user->save();
        });

        $this->user = new User;
        $this->alertSuccess( 'success','Usuario guardado');
    }

    public function alertSuccess( $type, $message ): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
