<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Models\Company;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if($user->role->name === 'SuperAdmin'){
            $clients = Company::withCount('users')->get();
            $shortUrls = ShortUrl::latest()->limit(10)->get();
            return view('superadmin.dashboard', compact('clients','shortUrls'));
        }

        if($user->role->name === 'Admin'){
            $team = User::where('company_id', $user->company_id)->get();
            $shortUrls = ShortUrl::where('company_id', $user->company_id)->latest()->paginate(10);
            return view('clientadmin.dashboard', compact('team','shortUrls'));
        }

        // Member
        $shortUrls = ShortUrl::where('created_by', $user->id)->latest()->paginate(10);
        return view('member.dashboard', compact('shortUrls'));
    }
}
