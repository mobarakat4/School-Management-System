<?php

namespace App\Repositories\Users;
use App\Models\Admin;
use App\Models\User;

Class AdminRepository implements UserRepositoryInterface{

    public function find($id){
        $admin = Admin::where('user_id',$id)->first();
        if($admin->added_by){
            $res['added_by'] = $admin->added_by;
        }else{
            $res['added_by'] = null;
        }
        $res['created_at'] = $admin->created_at;
        $res['updated_at'] = $admin->updated_at;
        return $res;
    }
    public function create($id){
        $admin = new Admin;
        $admin->user_id = $id;
        $admin->added_by = Admin::where('user_id',auth()->user()->id)->first(['id'])->id;
        $admin->save();
        // add role
        $user  = User::find($id);
        $user->role = 'admin';
        $user->save();
        return $admin;
    }
    public function update($request ,$id){
        $admin = Admin::where('user_id',$id)->first();
        $admin->updated_by = auth()->user()->admin->id;
        $admin->save();
        return $admin;
    }
    public function delete($id){
        $admin = Admin::where('user_id',$id)->first();

        $admin->delete();
        return $admin;
    }

}
