<?php

namespace App\Http\Controllers\Web\Admin\AdminManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminManagementRequest;
use App\Repositories\Users\StudentRepository;
use App\Services\Admin\UserManageService;
use App\Models\User;
use Illuminate\Http\Request;

class StudentManageController extends Controller
{
    private $student;

    public function __construct(){
        $this->student = new UserManageService(new StudentRepository); //ignores binding
        $this->middleware([
            'permission:admin manage'
        ]);
    }
    public function index(){
        $student = $this->student->get();
        return view('admin.admin_manage.show_all',compact('admins'));
    }
    public function show($id){
        $admin = $this->student->find($id);
        dd($admin);
    }
    public function create(){
        return view('admin.admin_manage.add');
    }
    public function store(AdminManagementRequest $request){
        $this->student->add($request);
        if($this->student->get_error()){
            $arr = [
                'message'=> ( $this->student->get_error()),
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
        $admin = $this->student->find($id);
        return view('admin.admin_manage.edit')->with(['admin'=>$admin]);
    }
    public function update(AdminManagementRequest $request , $id){
        $this->student->update($request,$id);
        if($this->student->get_error()){
            $arr = [
                'message'=> ( $this->student->get_error()),
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
        $this->student->delete($id);
        $arr = [
            'message'=> "admin deleted successfuly",
            'alert_type'=>'success',
        ];
        return redirect()->back()->with($arr);

    }



}
