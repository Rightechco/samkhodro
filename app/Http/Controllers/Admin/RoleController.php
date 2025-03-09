<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::latest()->get();
        return view('admin.role.index',compact('roles'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        foreach (json_decode($request->permissions) as $permission) {
            $role->givePermissionTo($permission);
        }
        return 'success';
    }
    public function edit(Request $request){
        return Role::where('id' , $request->role)->with('permissions')->first();
    }
    public function delete(Request $request , Role $role){
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }
        $role->delete();
        return redirect()->back()->with([
            'message' => 'مقام با موفقیت حذف شد'
        ]);
    }
    public function update(Role $role , Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $role->update([
            'name' => $request->name,
        ]);
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }
        foreach (json_decode($request->permissions) as $permission) {
            $role->givePermissionTo($permission);
        }
        return 'success';
    }
}
