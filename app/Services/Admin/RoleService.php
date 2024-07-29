<?php

namespace App\Services\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService{



    public function add_role($request){
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->permissions()->sync($request->permissions ?? []);

    }

    public function  update_role($request,$id){
        $role = Role::find($id);
        $role->update([
            'name' => $request->name
        ]);

        $role->permissions()->sync($request->permissions ?? []);
    }
    public function delete_role($id){
        $role = Role::find($id);
        $role->delete();
    }
}
