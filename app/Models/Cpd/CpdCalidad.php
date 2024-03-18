<?php

namespace App\Models\Cpd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdCalidad extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Calidad";
    protected $connection = 'roma';

    protected $primaryKey = "ID";


}
