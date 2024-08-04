<?php

namespace App\Repositories\Users;
use App\Models\Admin;
use App\Models\User;
use App\Models\Student;
use App\Services\Images\ImageService;

Class StudentRepository implements UserRepositoryInterface{
    private $image;
    public function __construct(){
        $this->image = new ImageService;
    }
    public function get(){
        $admins = new User;
        return $admins->where('role','student')->with(['student','address'])->get();

    }
    public function find($id){
        $student = Student::where('user_id',$id)->first();
        if($student->added_by){
            $res['enrolled_by'] = $student->added_by;
        }else{
            $res['enrolled_by'] = null;
        }
        $res['created_at'] = $student->created_at;
        $res['updated_at'] = $student->updated_at;
        return $res;
    }
    public function create($request ,$id){
        $student = new Student;
        $student->user_id = $id;
        $student->enrolled_by = Admin::where('user_id',auth()->user()->id)->first(['id'])->id;
        $student->save();
        // add role
        $user  = User::find($id);
        $user->role = 'student';
        if( $request->hasFile('photo')){

            $this->image->add($request->photo,'students',$user);
        }
        $user->save();
        return $student;
    }
    public function update($request ,$id){
        $student = Student::where('user_id',$id)->first();
        $student->save();
        if( $request->hasFile('photo')){
            $user  = User::find($id);
            $this->image->update( $request->photo, 'students', $user);
            $user->save();
        }
        return $student;
    }
    public function delete($id){
        $student = Student::where('user_id',$id)->first();

        $student->delete();
        return $student;
    }

}
