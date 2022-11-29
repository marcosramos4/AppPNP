<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $fillable = ['DNI', 'nombres', 'apellidos', 'rol_id', 'estado'];

    function Rol()
    {
        return $this->belongsTo(Rol::class);
    }
    public function User(){
        return $this->hasOne(User::class);
    }
    public function Registro() {
        return $this->hasMany('registro');
    }

}
