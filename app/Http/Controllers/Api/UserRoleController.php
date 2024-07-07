<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function assignRoles(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_ids' => 'required|array',
            'role_ids.*' => 'required|exists:roles,id',
        ]);
        $user=User::find($request->user_id);
        $user_roles=[];
        foreach($request->role_ids as $role_id)
        {
            if(UserRole::where(["user_id"=>$request->user_id,"role_id"=>$role_id])->exists())
            {
                continue;
            }
            $user_roles[]=["role_id"=>$role_id];
        }
        $user->UserRoles()->createMany($user_roles);
        return response()->json(["status"=>true,
        "message"=>"Assigned successfully"]);
    }
}
