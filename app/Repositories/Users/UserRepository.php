<?php
namespace App\Repositories\Users;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use App\Services\Images\ImageService;

class UserRepository implements UserRepositoryInterface{
    private $image;
    public function __construct(){
        $this->image = new ImageService;
    }
    public function find($id){
        $res = [];
        $user = User::whereId($id)->first();
        $res['id'] = $user->id;
        $res['name'] = $user->name;
        $res['username'] = $user->username;
        $res['email'] = $user->email;
        $res['phone'] = $user->phone;
        $res['photo'] = $user->photo;
        $res['status'] = $user->status;
        if($user->address_id){
            $address = Address::whereId($user->address_id)->first();
            $res['address'] = $address->address;
            $res['city'] = $address->city;
        }else{
            $res['address'] = null;
            $res['city'] = null;
        }
        return $res;
    }
    public function create($request){
            $user = new User;
            $user->name = $request->name?? null;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone??null;
            $user->status = $request->status;
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
            if( $request->hasFile('photo')){

                $this->image->add($request->photo,'admins',$user);
            }
            $user->save();
            return $user;
    }
    public function update($request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        if($request->address || $request->city){     //check if there is address or city
            if($user->address_id){                   // check if there is previeus address or city
                $address = Address::find($user->address_id);
            }else{
                $address = new Address;
            }
            $address->address = $request->address;
            $address->city = $request->city;
            $address->save();
            $user->address_id = $address->id;
        }else{
            if($user->address_id){
                $address = Address::find($user->address_id);
                $address->address = $request->address;
                $address->city = $request->city;
                $address->save();
            }
        }
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        if( $request->hasFile('photo')){
            $this->image->update( $request->photo, 'admins', $user);
        }
        $user->save();
        return $user;
    }
    public function delete($id){
        $user = User::find($id);
        if($user->address_id){
            $address = Address::find($user->address_id);
            $user->address_id = null;
            $user->save();
            $address->delete();
        }
        $ref = $user; // return user before deleted
        $user->delete();
        return $ref;
    }
}
