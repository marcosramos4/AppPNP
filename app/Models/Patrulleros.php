<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrulleros extends Model
{
    use HasFactory;
    protected $fillable = ['placa', 'descripcion', 'estado'];
}
