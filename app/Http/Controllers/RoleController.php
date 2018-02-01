<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\RolePermission;
use DB;

class RoleController extends Controller
{
    // danh sach nhóm vai trò
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        $i = 0;
        return view('roles.index',compact('roles', 'i'));
    }

    // lay view them
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    // them nhóm vai trò
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|unique:roles,role_name',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);

        $role = new Role();
        $role->role_name = $request->input('role_name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
    }

    // show nhóm vai trò
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->select('permissions.name')
            ->get();

        return view('roles.show',compact('role','rolePermissions', 'id'));
    }

    // lay view sua
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = RolePermission::where('role_id', $id)->select('permission_id')->get();
//        dd($rolePermissions->toArray());

        return view('roles.edit',compact('role','permission', 'rolePermissions', 'id'));
    }

    // sua nhóm vai trò
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->role_name = $request->input('role_name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }

    // xóa nhóm vai trò
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}
