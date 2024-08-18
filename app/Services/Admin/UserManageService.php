<?php
namespace App\Services\Admin;

use App\Services\Images\ImageService;
use App\Models\Address;
use App\Models\User;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\AdminRepository;
use App\Repositories\Users\UserRepositoryInterface;
use Spatie\Permission\Models\Role;

class UserManageService{

    private $error;

    private $image_service ;
    private $user_repo ;
    private $usermanage ;
    public function __construct(UserRepositoryInterface $usermanage){
        $this->image_service = new ImageService;
        $this->user_repo = new UserRepository;
        $this->usermanage = $usermanage;
    }
    function get(){
        $admins = new User;
        // $admins  = $admins->where('role','admin')->with(['admin','address'])->get();
        $admins = $this->usermanage->get();
        // $result = $admins->where('role','admin')->get();
        // $admins = $admins->user()->get();
        // dd($result);
        return  $admins;
    }
    function find($id){
        $user = $this->user_repo->find($id);// get user table details
        $admin = $this->usermanage->find($user['id']);
        return array_merge($user,$admin);
    }
    public function add($request){
        try{
            $user = $this->user_repo->create($request);
            $this->usermanage->create($request , $user->id);
        }catch(Exception $e){
            $this->error = $e->getMessage();
        }
    }
    public function update($request ,$id){
        $user = $this->user_repo->update($request,$id); // update users table

        $this->usermanage->update( $request ,$user->id ); // update admin table to add updated by

    }
    public function delete($id){
        $user =$this->user_repo->delete($id);

        // dd($this->usermanage->delete($user->id)); // no need for it because in delete cascade
        return $user;
    }
    public function getroles($id){
        // $user = User::with('roles')->find(1);
        $user = User::with('roles')->find($id);
        $roles = Role::get();
        $userroles = $user->roles->pluck('name')->toarray();
        $arr =array();
        // dd($userroles);
        $arr['user'] = $user;
        $arr['roles'] = $roles;
        $arr['userroles'] = $userroles;
        return $arr;

    }
    public function roles($request , $id){
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return $user;
    }

    public function get_error(){
        return $this->error;
    }
}
