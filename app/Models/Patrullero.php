<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrullero extends Model
{
    use HasFactory;
    public function PatrulleroCategoria(){
        return $this->belongsTo(PatrulleroCategoria::class);
    }
    public function PatrulleroEstado(){
        return $this->belongsTo(PatrulleroEstado::class);
    }
}
