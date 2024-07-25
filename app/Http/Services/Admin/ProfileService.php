<?php

namespace App\Http\Services\Admin;

use App\Models\Address;
use App\Models\User;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileService{
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
            $exist = Storage::disk('public')->exists('images/admins/'.$user->photo);
            if($exist){
                Storage::disk('public')->delete('images/admins/'.$user->photo);

            }

            $imageName = Str::random().'.'.$request->photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/admins/', $request->photo , $imageName);
            $user->photo = $imageName;
            // dd('error');

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
