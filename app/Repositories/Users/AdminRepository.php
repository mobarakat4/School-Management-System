<?php

namespace App\Repositories\Users;
use App\Models\Admin;

Class AdminRepository{

    public function create($id){
            $admin = new Admin;
            $admin->user_id = $id;
            $admin->added_by = Admin::where('id',auth()->user()->id)->first(['id'])->id;
            $admin->save();
    }
}
