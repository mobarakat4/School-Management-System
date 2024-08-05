<?php

namespace App\Services\Admin;

use App\Models\GradeLevel;

Class GradeLevelService{
    public function index(){
        $levels = GradeLevel::get();
        return $levels;
    }
    public function store($request){
        GradeLevel::create($request);
    }
}
