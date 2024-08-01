<?php

namespace App\Http\Controllers\Web\Admin\AdminManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminManagementRequest;
use App\Repositories\Users\TeacherRepository;
use App\Services\Admin\UserManageService;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherManageController extends Controller
{
    private $teacher;

    public function __construct(){
        $this->teacher = new UserManageService(new TeacherRepository); //ignores binding
        $this->middleware([
            'permission:admin manage'
        ]);
    }
    public function index(){
        $teacher = $this->teacher->get();
        return view('admin.admin_manage.show_all',compact('admins'));
    }
    public function show($id){
        $teacher = $this->teacher->find($id);
        dd($teacher);
    }
    public function create(){
        return view('admin.admin_manage.add');
    }
    public function store(AdminManagementRequest $request){
        $this->teacher->add($request);
        if($this->teacher->get_error()){
            $arr = [
                'message'=> ( $this->teacher->get_error()),
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
        $admin = $this->teacher->find($id);
        return view('admin.admin_manage.edit')->with(['admin'=>$admin]);
    }
    public function update(AdminManagementRequest $request , $id){
        $this->teacher->update($request,$id);
        if($this->teacher->get_error()){
            $arr = [
                'message'=> ( $this->teacher->get_error()),
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
        $this->teacher->delete($id);
        $arr = [
            'message'=> "admin deleted successfuly",
            'alert_type'=>'success',
        ];
        return redirect()->back()->with($arr);

    }



}
