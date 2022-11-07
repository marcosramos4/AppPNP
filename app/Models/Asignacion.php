<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $fillable=['patrullero_id','sector_id','estado'];
    function Patrullero(){
        return $this->belongsTo(Patrullero::class);
    }
    function Sector(){
        return $this->belongsTo(Sector::class);
    }
}
