<?php
namespace App\Http\Services\Admin;

use App\Http\Services\Images\ImageService;
use App\Models\Address;
use App\Models\User;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AdminManageService{

    private $error;

    private $image_service ;
    public function __construct(){
        $this->image_service = new ImageService;
    }
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
        $admin = Admin::where('user_id',$user->id)->first();
        if($admin->added_by){
            $res['added_by'] = $admin->added_by;
        }else{
            $res['added_by'] = null;
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

                $this->image_service->add($request,'admins',$user);
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
    public function update_admin($request ,$id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
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
            $this->image_service->update($request,'admins',$user);
        }


        //TODO (add updated by )
        $user->save();
        $admin = $user->admin;
        // dd(auth()->user()->admin->id);
        $admin->updated_by = auth()->user()->admin->id;
        $admin->save();
    }
    public function delete_admin($id){
        $user = User::find($id);
        if($user->address_id){
            $address = Address::find($user->address_id);
            $user->address_id = null;
            $user->save();
            $address->delete();
        }
        $admin = Admin::where('user_id',$user->id)->first();
        $admin->delete();
        $user->delete();
    }

    public function get_error(){
        return $this->error;
    }
}
