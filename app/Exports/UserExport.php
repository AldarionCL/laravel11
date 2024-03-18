<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromQuery, WithHeadings, WithMapping
{
    public $register;

    public function __construct($register)
    {

        $this->register = $register;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Email',
            'Telefono Oficina',
            'Celular',
            'Perfil',
            'Cargo',
            'Disponible',
            'Activo'
        ];
    }

    public function map($user): array
    {
        return [
            $user->ID,
            $user->Nombre,
            $user->Email,
            $user->TelefonoOficina,
            $user->Celular,
            $user->profile->Perfil,
            $user->position->Cargo,
            $user->Activo ? 'SI' : 'NO',
            $user->Disponible ? 'SI' : 'NO'
        ];
    }

    public function query()
    {
        return User::with('profile', 'position')->whereIn('ID', $this->register);
    }
}
