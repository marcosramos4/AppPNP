<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable=['DNI','nombres','apellidos','correo','usuario','password','rol_id','estado'];

    function Rol(){
        return $this->belongsTo(Rol::class);
    }
}
