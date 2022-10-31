<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    use HasFactory;
    protected $fillable=['cordenadas','detalle','fotos','sector_id','estado'];
    function Sector(){
        return $this->belongsTo(Sector::class);
    }
}
