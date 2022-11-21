<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    protected $fillable=['latitud', 'longitud','detalle','personal_id','estado'];
    function Personal(){
        return $this->belongsTo(Personal::class);
    }
}
