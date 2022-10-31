<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSector extends Model
{
    use HasFactory;
    protected $fillable=['lugar','direccion','descripcion','sector_id','estado'];
    function Sector(){
        return $this->belongsTo(Sector::class);
    }
}
