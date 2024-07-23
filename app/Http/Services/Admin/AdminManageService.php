<?php
namespace App\Http\Services\Admin;

use App\Models\Address;
use App\Models\User;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AdminManageService{

    private $error;

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
    public function add_admin($request){
        try{

            $user = new User;
            $user->name = $request->name?? null;
            $user->username = $request->username;
            $user->role = 'admin';
            $user->email = $request->email;
            $user->phone = $request->phone??null;
            $user->password = Hash::make($request->password);
            if($request->address || $request->city){
                $address = new Address;
                $address->address = $request->address??null;
                $address->city = $request->city??null;
                $address->save();
                $user->address_id = $address->id;
            }
            if( $request->hasFile('photo')){

                $imageName = Str::random().'.'.$request->photo->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('images/admins/', $request->photo , $imageName);
                $user->photo = $imageName;
                // dd('error');
            }
            $user->save();
            $admin = new Admin;
            $admin->user_id = $user->id;
            $admin->added_by = Admin::where('id',auth()->user()->id)->first(['id'])->id;
            $admin->save();
        }catch(Exception $e){
            $this->error = $e->getMessage();
        }
    }

    public function get_error(){
        return $this->error;
    }
}
