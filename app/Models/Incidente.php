<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    use HasFactory;
    protected $fillable=['latitud', 'longitud','detalle','fotos','sector_id','tipo_id','estado'];
    function Sector(){
        return $this->belongsTo(Sector::class);
    }
    function Tipo(){
        return $this->belongsTo(Tipo::class);
    }
    protected $hidden = [
        'sector_id',
        'tipo_id',
    ];
}
