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
        $admins  =$admins->with(['admin','address']);
        $result = $admins->where('role','admin')->get();
        // $admins = $admins->user()->get();
        // dd($result);
        return  $result;
    }
    function find($id){
        $user = $this->user_repo->find($id);// get user table details
        $admin = $this->usermanage->find($user['id']);
        return array_merge($user,$admin);
    }
    public function add($request){
        try{
            $user = $this->user_repo->create($request);
            $this->usermanage->create($user->id);
        }catch(Exception $e){
            $this->error = $e->getMessage();
        }
    }
    public function update($request ,$id){
        $user = $this->user_repo->update($request,$id); // update users table

        $this->usermanage->update( null ,$user->id ); // update admin table to add updated by

    }
    public function delete($id){
        $user =$this->user_repo->delete($id);

        // dd($this->usermanage->delete($user->id)); // no need for it because in delete cascade


    }

    public function get_error(){
        return $this->error;
    }
}
