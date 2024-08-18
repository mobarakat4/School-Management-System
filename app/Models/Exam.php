<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function classes(){
        return $this->belongsToMany(
            Classname::class,
            'exam_class',
            'exam_id',
            'class_id'
        );
    }
}
