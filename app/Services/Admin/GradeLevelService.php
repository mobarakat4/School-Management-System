<?php

namespace App\Services\Admin;

use App\Models\GradeLevel;

Class GradeLevelService{
    public function index(){
        $levels = GradeLevel::get();
        return $levels;
    }
    public function find($id){
        $level = GradeLevel::find($id);
        return $level;
    }
    public function store($request){
        $level = GradeLevel::create($request);
        return $level;

    }
    public function update($request,$id){
        $level = GradeLevel::find($id);
        $level->update($request);
        return $level;
    }
    public function delete($id){
        $level = GradeLevel::find($id);
        $level->delete();
        return $level;
    }
}
