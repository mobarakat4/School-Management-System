<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;
    protected $fillable=[
        'level','start_year','end_year'
    ];


    public function classes(){
        return $this->hasMany(Classname::class,'grade_year');
    }
}
