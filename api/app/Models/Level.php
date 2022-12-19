<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'libele'
    ];

    
    public function specialities(){
        return $this->hasMany('\App\Models\Speciality', 'levels_id');
    }
    
    public function cours(){
        return $this->hasMany('\App\Models\Cours', 'specialities_id');
    }
}
