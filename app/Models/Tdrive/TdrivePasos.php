<?php

namespace App\Models\Tdrive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TdrivePasos extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = "TDRIVE_Pasos";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";


}
