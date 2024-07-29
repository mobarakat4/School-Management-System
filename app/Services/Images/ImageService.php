<?php
namespace App\Services\Images;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ImageService {
    private $main_path = 'images';

    public function add($photo,$path,&$user):void{
        $imageName = Str::random().'.'.$photo->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($this->main_path."/".$path.'/', $photo , $imageName);
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

