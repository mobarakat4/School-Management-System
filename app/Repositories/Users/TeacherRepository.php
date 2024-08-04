<?php

namespace App\Repositories\Users;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use App\Services\Images\ImageService;

Class TeacherRepository implements UserRepositoryInterface{
    private $image;
    public function __construct(){
        $this->image = new ImageService;
    }
    public function get(){
        $admins = new User;
        return $admins->where('role','teacher')->with(['teacher','address'])->get();

    }
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
    public function create($request , $id){
        $teacher = new Teacher;
        $teacher->user_id = $id;
        $teacher->hired_by = Admin::where('user_id',auth()->user()->id)->first(['id'])->id;
        $teacher->save();
        // add role
        $user  = User::find($id);
        $user->role = 'teacher';
        if( $request->hasFile('photo')){

            $this->image->add($request->photo,'teachers',$user);
        }
        $user->save();
        return $teacher;
    }
    public function update($request ,$id){
        $teacher = Teacher::where('user_id',$id)->first();
        $teacher->save();
        if( $request->hasFile('photo')){
            $user  = User::find($id);
            $this->image->update( $request->photo, 'teachers', $user);
            $user->save();
        }
        return $teacher;
    }
    public function delete($id){//not needed right now
        $admin = Teacher::where('user_id',$id)->first();
        $admin->delete();
        return $admin;
    }

}
