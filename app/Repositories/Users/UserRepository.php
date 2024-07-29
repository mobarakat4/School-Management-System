<?php
namespace App\Repositories\Users;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserRepository{
    public function create($request){
            $user = new User;
            $user->name = $request->name?? null;
            $user->username = $request->username;
            $user->role = 'admin';
            $user->email = $request->email;
            $user->phone = $request->phone??null;
            if($request->password){
                $user->password = Hash::make($request->password);
            }else{
                $user->password = Hash::make('admin'); // default password is (admin)
            }
            if($request->address || $request->city){
                $address = new Address;
                $address->address = $request->address??null;
                $address->city = $request->city??null;
                $address->save();
                $user->address_id = $address->id;
            }
            return $user;
    }
}
