<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Services\Admin\ProfileService;
use App\Models\Address;
use App\Models\User;
use App\Notifications\ProfileChanged;

use function PHPUnit\Framework\isNull;

class ProfileController extends Controller
{
    //
    private $profile;
    public function __construct(ProfileService $profileService){
        $this->profile = $profileService;
    }
    public function index(){
        $user  = auth()->user();
        return view('admin.profile',compact('user'));
    }

    public function update(ProfileRequest $request){
        $this->profile->update_profile($request);
        $user = User::find(auth()->id());
        $user->notify( new ProfileChanged());
        return redirect()->back()->with([
            'message'=> "Profile Updated successfully",
            'alert_type'=>"success"
        ]);
    }
    public function viewChangePassword(){
        $user =  auth()->user();
        return view('admin.changePassword',compact('user'));
    }
    public function changePassword(ChangePasswordRequest $request){
        $arr = $this->profile->update_password($request);
        return redirect()->back()->with($arr);

    }
}
