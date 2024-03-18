<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DypPasos extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = "DYP_Pasos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";


}
