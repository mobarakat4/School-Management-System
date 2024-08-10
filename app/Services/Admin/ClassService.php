<?php

namespace App\Services\Admin;
use App\Models\Classname;
class ClassService{
    public function index(){
        $classes = Classname::get();
        return $classes;
    }
    public function find($id){
        $level = Classname::find($id);
        return $level->with('classes');
    }
    public function store($request){
        $class = new Classname;
        $class->class_name = $request->name; // add name of the class
        $class->grade_year = $request->level_id; // foreign key to table gradelevel
        $class->save();
        return $class;

    }
    public function update($request,$id){
        $class = Classname::find($id);
        $class->class_name = $request->name; // update name of the class
        $class->grade_year = $request->level_id; // foreign key to table gradelevel
        $class->save();
        return $class;
    }
    public function delete($id){
        $class = Classname::find($id);
        $class->delete();
        return $class;
    }
}
