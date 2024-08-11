<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teachers(){
        return $this->belongsToMany(
            Subject::class,
            'subject_teacher',
            'subject_id',
            'teacher_id',
            'id',
            'id'
        );
    }
    public function classes(){
        return $this->belongsToMany(
            Classname::class,
            'subject_class',
            'subject_id',
            'class_id',
            'id',
            'id'
        );
    }
}
