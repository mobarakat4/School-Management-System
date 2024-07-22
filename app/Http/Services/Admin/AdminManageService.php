<?php
namespace App\Http\Services\Admin;

use App\Models\Address;
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
    function get_admin($id){
        $res = [];
        $admin = User::whereId($id)->first();
        $res['id'] = $admin->id;
        $res['name'] = $admin->name;
        $res['username'] = $admin->username;
        $res['phone'] = $admin->phone;
        $res['photo'] = $admin->photo;
        $res['status'] = $admin->status;
        if($admin->address_id){
            $address = Address::whereId($admin->address_id)->first();
            $res['address'] = $address->address;
            $res['city'] = $address->city;
        }else{
            $res['address'] = 'no address';
            $res['city'] = 'no city';
        }
        $admin = Admin::where('user_id',$admin->id)->first();
        if($admin->added_by){
            $res['added_by'] = $admin->added_by;
        }else{
            $res['added_by'] = "none";
        }
        $res['created_at'] = $admin->created_at;
        $res['updated_at'] = $admin->updated_at;
        return $res;
    }
}
