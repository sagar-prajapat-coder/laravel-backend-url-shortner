<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;

class ClientController extends Controller
{
    public function index(){ $clients = Company::withCount('users')->get(); return view('superadmin.clients', compact('clients')); }
    public function create(){ return view('superadmin.create-client'); }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $client = Company::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }
}