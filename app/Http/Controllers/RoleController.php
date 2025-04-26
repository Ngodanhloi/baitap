<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function readRole($role_id){
            $role = Role::findOrFail($role_id); // Lấy vai trò hoặc báo lỗi nếu không tìm thấy
            $users = User::whereHas('roles', function ($query) use ($role_id) {
                $query->where('roles.id', $role_id);
            })->with('roles')->get(); // Lấy người dùng có vai trò này
    
            return view('crud_user.role', compact('users', 'role'));
    }
}
