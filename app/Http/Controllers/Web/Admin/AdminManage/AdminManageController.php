<?php

namespace App\Http\Controllers\Web\Admin\AdminManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminManagementRequest;
use App\Http\Services\Admin\AdminManageService;
use App\Models\User;
use Illuminate\Http\Request;

class AdminManageController extends Controller
{
    private $admin;

    public function __construct(){
        $this->admin = new AdminManageService;
        $this->middleware([
            'permission:adminmanage'
        ]);
    }
    public function index(){
        $admins = $this->admin->get_admins();
        return view('admin.admin_manage.show_all',compact('admins'));
    }
    public function show($id){
        $admin = $this->admin->get_admin($id);
        dd($admin);
    }
    public function create(){
        return view('admin.admin_manage.add');
    }
    public function store(AdminManagementRequest $request){
        $this->admin->add_admin($request);
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
        $admin = $this->admin->get_admin($id);
        return view('admin.admin_manage.edit')->with(['admin'=>$admin]);
    }
    public function update(AdminManagementRequest $request , $id){
        $this->admin->update_admin($request,$id);
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
        $this->admin->delete_admin($id);
        $arr = [
            'message'=> "admin deleted successfuly",
            'alert_type'=>'success',
        ];
        return redirect()->back()->with($arr);

    }



}
