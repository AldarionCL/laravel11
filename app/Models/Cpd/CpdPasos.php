<?php

namespace App\Models\Cpd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CpdPasos extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = "CPD_Pasos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";


}
