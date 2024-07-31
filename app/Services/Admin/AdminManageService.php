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
class AdminManageService{

    private $error;

    private $image_service ;
    private $user_repo ;
    private $admin_repo ;
    public function __construct(){
        $this->image_service = new ImageService;
        $this->user_repo = new UserRepository;
        $this->admin_repo = new AdminRepository;
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
        $user = $this->user_repo->find($id);// get user table details
        $admin = $this->admin_repo->find($user['id']);
        return array_merge($user,$admin);
    }
    public function add_admin($request){
        try{
            $user = $this->user_repo->create($request);
            $this->admin_repo->create($user->id);
        }catch(Exception $e){
            $this->error = $e->getMessage();
        }
    }
    public function update_admin($request ,$id){
        $user = $this->user_repo->update($request,$id); // update users table

        $this->admin_repo->update( null ,$user->id ); // update admin table to add updated by

    }
    public function delete_admin($id){
        $user =$this->user_repo->delete($id);

        // dd($this->admin_repo->delete($user->id)); // no need for it because in delete cascade


    }

    public function get_error(){
        return $this->error;
    }
}
