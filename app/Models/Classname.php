<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classname extends Model
{
    use HasFactory;
    protected $table = "classes";
    protected $guarded = [];

    public function level(){
        return $this->belongsTo(GradeLevel::class,'grade_year');
    }

    public function subjects(){
        return $this->belongsToMany(
            Subject::class,
            'subject_class',
            'class_id',
            'subject_id',
            'id',
            'id'
        );
    }
    public function teachers(){
        return $this->belongsToMany(
            Teacher::class,
            'teacher_class',
            'class_id',
            'teacher_id',
            'id',
            'id'
        );
    }
    public function exams(){
        return $this->belongsToMany(
            exam::class,
            'exam_class',
            'class_id',
            'exam_id',
            'id',
            'id'
        );
    }
}
