<?php

namespace App\Services\Admin;

use App\Models\Address;
use App\Models\User;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\Images\ImageService;

class ProfileService{
    private $image_service;
    public function __construct(){
        $this->image_service = new ImageService;
    }
    public function update_profile($request){
        $user = User::where('id',auth()->user()->id)->first();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($user->address_id){
            $address = Address::where('id',$user->address_id)->first();
            $address->address = $request->address;
            $address->city = $request->city;
            $address->save();

        }else{
            $address  = new Address();
            $address->address = $request->address;
            $address->city = $request->city;
            $address->save();
            $user->address_id = $address->id;
        }

        if( $request->hasFile('photo')){
            $this->image_service->update( $request->photo, 'admins', $user);
        }
        $user->save();
    }
    public function update_password($request){
        $user  = User::find(auth()->user()->id);
        if($user && Hash::check($request->old_password,$user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            $arr = [
                'message'=> "Password Updated successfully",
                'alert_type'=>'success'
            ];
            // dd('stop');
        }else{
            $arr = [
                'message'=> "Password Incorrect",
                'alert_type'=>'error'
            ];
            // dd('else stop');
        }
    }
}
