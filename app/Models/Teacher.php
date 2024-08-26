<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
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
