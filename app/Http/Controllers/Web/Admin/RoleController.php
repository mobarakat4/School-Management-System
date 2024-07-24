<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Services\Admin\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $role;
    public function __construct(RoleService $roleService){
        $this->role = $roleService;
    }
    public function index()
    {
        $roles = Role::with('permissions')->get();
        // dd($roles);
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->role->add_role($request);
        $arr = [
            'message'=> "role added successfuly",
            'alert_type'=>'success'
        ];
        return redirect()->back()->with($arr);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        // $ro
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->find( $id);
        $permissions = Permission::get();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $this->role->update_role( $request, $id);
        $arr = [
            'message'=> "role updated successfuly",
            'alert_type'=>'success'
        ];
        return redirect()->back()->with($arr);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->role->delete_role($id);
        $arr = [
            'message'=> "role deleted successfuly",
            'alert_type'=>'success'
        ];
        return redirect()->back()->with($arr);

    }
}
