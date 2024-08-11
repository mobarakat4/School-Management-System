<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subjects(){
        return $this->belongsToMany(
            Subject::class,
            'subject_teacher',
            'teacher_id',
            'subject_id',
            'id',
            'id'
        );
    }
    public function classes(){
        return $this->belongsToMany(
            Classname::class,
            'teacher_class',
            'teacher_id',
            'class_id',
            'id',
            'id'
        );
    }
}
