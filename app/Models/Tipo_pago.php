<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
