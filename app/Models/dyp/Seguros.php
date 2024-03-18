<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seguros extends Model
{
    use HasFactory;

    protected $table = "VT_Seguros";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [];


}
