<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'cours_id',
        'image_path',
        'video_path',
    ];

    public function cours()
    {
        return $this->belongsTo('\App\Models\Cours', 'cours_id');
    }
}
