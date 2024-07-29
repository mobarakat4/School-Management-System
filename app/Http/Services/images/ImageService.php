<?php
namespace App\Http\Services\Images;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ImageService {
    private $main_path = 'images';

    public function add(&$request,$path,&$user):void{
        $imageName = Str::random().'.'.$request->photo->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($this->main_path."/".$path.'/', $request->photo , $imageName);
        $user->photo = $imageName;
    }
    public function delete($path,&$user):void{
        $exist = Storage::disk('public')->exists('images/admins/'.$user->photo);
        if($exist){
            Storage::disk('public')->delete('images/admins/'.$user->photo);
        }
    }
    public function update(&$request,$path,&$user):void{
        $this->delete($path,$user);
        $this->add($request,$path,$user);
    }
}

