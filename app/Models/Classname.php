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
}
