<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'libele',
        'levels_id'
    ];
    
    public function level(){
        return $this->belongsTo('\App\Models\Level', 'levels_id');
    }

    public function cours(){
        return $this->hasMany('\App\Models\Cours', 'specialities_id');
    }
}
