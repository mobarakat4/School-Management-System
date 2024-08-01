<?php

namespace App\Repositories\Users;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
Class TeacherRepository implements UserRepositoryInterface{
    public function find($id){
        $teacher = Teacher::where('user_id',$id)->first();
        if($teacher->added_by){
            $res['added_by'] = $teacher->added_by;
        }else{
            $res['added_by'] = null;
        }
        $res['created_at'] = $teacher->created_at;
        $res['updated_at'] = $teacher->updated_at;
        return $res;
    }
    public function create($id){
        $teacher = new Teacher;
        $teacher->user_id = $id;
        $teacher->hired_by = Admin::where('user_id',auth()->user()->id)->first(['id'])->id;
        $teacher->save();
        // add role
        $user  = User::find($id);
        $user->role = 'teacher';
        $user->save();
        return $teacher;
    }
    public function update($request ,$id){
        $teacher = Teacher::where('user_id',$id)->first();
        $teacher->save();
        return $teacher;
    }
    public function delete($id){//not needed right now
        $admin = Teacher::where('user_id',$id)->first();
        $admin->delete();
        return $admin;
    }

}
