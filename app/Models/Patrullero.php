<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrullero extends Model
{
    use HasFactory;
    protected $fillable=['placa','vehiculo_id','estado_id','descripcion'];
    function Estado(){
        return $this->belongsTo(Estado::class);
    }
    function Vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }
}
