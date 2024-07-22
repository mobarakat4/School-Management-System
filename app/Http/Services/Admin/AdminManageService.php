<?php
namespace App\Http\Services\Admin;
use App\Models\User;
use App\Models\Admin;
class AdminManageService{


    function get_admins(){
        $admins = new User;
        $admins  =$admins->with(['admin','address']);
        $result = $admins->where('role','admin')->get();
        // $admins = $admins->user()->get();
        // dd($result);
        return  $result;
    }
}
