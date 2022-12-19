<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'levels_id',
        'image_path',
        'specialities_id',
    ];

    public function speciality(){
        return $this->belongsTo('\App\Models\Speciality', 'specialities_id');
    }
    
    public function level(){
        return $this->belongsTo('\App\Models\Level', 'levels_id');
    }
    
    public function lessons(){
        return $this->hasMany('\App\Models\Lesson', 'cours_id');
    }
}
