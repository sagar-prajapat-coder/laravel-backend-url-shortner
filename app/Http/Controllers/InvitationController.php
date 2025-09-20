<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    public function invite(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'role'=>'required|string',
            'company_id'=>'nullable|integer'
        ]);

        $inviter = $request->user();
        $role = Role::where('name',$request->role)->firstOrFail();

      
        if($inviter->isSuperAdmin() && $role->name === 'Admin') {
            return response()->json(['message'=>'SuperAdmin cannot invite Admin in a new company'],403);
        }

        if($inviter->role->name === 'Admin' && in_array($role->name,['Admin','Member'])) {
            return response()->json(['message'=>'Admin cannot invite Admin or Member in their own company'],403);
        }

        $inv = Invitation::create([
            'email'=>$request->email,
            'role_id'=>$role->id,
            'company_id'=>$request->company_id ?? $inviter->company_id,
            'invited_by'=>$inviter->id
        ]);

        return response()->json(['invitation'=>$inv],201);
    }
}
