<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntouchAgendamiento extends Model
{
    use HasFactory;
    protected $connection = 'roma';
    protected $table = "IntouchAgendamientos";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'id_externo',
        'rut',
        'nombres',
        'email',
        'telefono',
        'marca',
        'modelo',
        'patente',
        'vin',
        'fecha',
        'hora',
        'fecha_agenda',
        'sucursal',
        'recepcionista',
        'tipo_servicio',
        'kilometraje',
        'servicio_agendado',
        'venta',
        'estado',
        'comentarios',
        'usuario',
        'usuario_actualiza',
        'fecha_actualiza',
        'marca_txt',
        'sucursal_txt',
        'agenda_venta',
        'usuario_id',
        'usuario_id_actualiza'
    ];


    public function Usuario()
    {
        return $this->hasOne(User::class, 'ID', 'usuario_id');
    }

    public function UsuarioActualiza()
    {
        return $this->hasOne(User::class, 'ID', 'usuario_id_actualiza');
    }

    public function Cliente()
    {
        return $this->hasOne(Clientes::class, 'Rut', 'rut');
    }


}
