<?php
namespace App\Http\Services\Admin;
use App\Models\User;
use App\Models\Admin;
class AdminManageService{


    function get_admins(){
        $admins = new User;
        $result = $admins->with(['admin','address'])->get();
        return  $result;
    }
}
