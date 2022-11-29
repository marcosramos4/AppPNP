<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable=['nombre','cordenadas','descripcion','estado'];
    public function Incidente() {
        return $this->hasMany('Incidente');
    }public function Registro() {
        return $this->hasMany('registro');
    }
    public function SubSector(){
        return $this->hasOne(SubSector::class);
    }
}
