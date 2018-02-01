<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\RoleUser;
use Hash;
use DB;

class UserController extends Controller
{
    // lay danh sach user
    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        $i = 0;
        return view('users.index',compact('users', 'i'));
    }

    // lay viem them quan tri vien
    public function create()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    // them quan tri vien
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->attachRole($request->roles);

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    // lay view sua
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        $roleUser = RoleUser::where('user_id', $id)->first();
        return view('users.edit', compact('user', 'roleUser', 'roles'));
    }

    // sua quan tri vien
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        if ($request->has('roles'))
        {
            DB::table('role_user')->where('user_id',$id)->delete();
            $user->attachRole($request->roles);
        }

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    // xóa quản trị viên
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
