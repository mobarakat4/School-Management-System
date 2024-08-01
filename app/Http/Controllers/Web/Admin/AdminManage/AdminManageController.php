<?php

namespace App\Http\Controllers\Web\Admin\AdminManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminManagementRequest;
use App\Repositories\Users\AdminRepository;
use App\Services\Admin\UserManageService;
use App\Models\User;
use Illuminate\Http\Request;

class AdminManageController extends Controller
{
    private $admin;

    public function __construct(UserManageService $userManageService){
        // $this->admin = new UserManageService(new AdminRepository); //ignores binding
        $this->admin = $userManageService;
        $this->middleware([
            'permission:admin manage'
        ]);
    }
    public function index(){
        $admins = $this->admin->get();
        return view('admin.admin_manage.show_all',compact('admins'));
    }
    public function show($id){
        $admin = $this->admin->find($id);
        dd($admin);
    }
    public function create(){
        return view('admin.admin_manage.add');
    }
    public function store(AdminManagementRequest $request){
        $this->admin->add($request);
        if($this->admin->get_error()){
            $arr = [
                'message'=> ( $this->admin->get_error()),
                'alert_type'=>'error'
            ];

        }else{
            $arr = [
                'message'=> "admin added successfuly",
                'alert_type'=>'success'
            ];

        }
        return redirect()->back()->with($arr);
    }
    public function edit($id){
        $admin = $this->admin->find($id);
        return view('admin.admin_manage.edit')->with(['admin'=>$admin]);
    }
    public function update(AdminManagementRequest $request , $id){
        $this->admin->update($request,$id);
        if($this->admin->get_error()){
            $arr = [
                'message'=> ( $this->admin->get_error()),
                'alert_type'=>'error'
            ];

        }else{
            $arr = [
                'message'=> "admin updated successfuly",
                'alert_type'=>'success'
            ];

        }
        return redirect()->back()->with($arr);
    }
    public function destroy($id){
        $this->admin->delete($id);
        $arr = [
            'message'=> "admin deleted successfuly",
            'alert_type'=>'success',
        ];
        return redirect()->back()->with($arr);

    }



}
