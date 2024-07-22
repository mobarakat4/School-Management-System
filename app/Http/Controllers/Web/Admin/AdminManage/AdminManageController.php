<?php

namespace App\Http\Controllers\Web\Admin\AdminManage;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AdminManageService;
use App\Models\User;
use Illuminate\Http\Request;

class AdminManageController extends Controller
{
    private $admin ;

    public function __construct(){
        $this->admin = new AdminManageService;
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
    public function store(){
        dd('hello');
    }
    public function edit(){

    }

}
