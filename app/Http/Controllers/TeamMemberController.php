<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index(){ $user = auth()->user(); $team = User::where('company_id',$user->company_id)->get(); return view('clientadmin.team', compact('team')); }
    public function create(){ $roles = Role::whereIn('name',['Admin','Member','Sales','Manager'])->get(); return view('clientadmin.create-team-member', compact('roles')); }
    public function store(Request $r){
        $r->validate(['name'=>'required','email'=>'required|email','role_id'=>'required|exists:roles,id']);
        $user = auth()->user();
        User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>bcrypt(Str::random(10)),
            'company_id'=>$user->company_id,
            'role_id'=>$r->role_id
        ]);
        return redirect()->route('team.index')->with('success','Team member invited');
    }
}
