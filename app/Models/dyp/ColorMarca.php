<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColorMarca extends Model
{
    use HasFactory;

    protected $table = "MA_ColorMarca";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'Color',
        'MarcaID'
    ];


}
