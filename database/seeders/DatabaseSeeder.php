<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Company;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['name'=>'SuperAdmin'],
            ['name'=>'Admin'],
            ['name'=>'Member'],
            ['name'=>'Sales'],
            ['name'=>'Manager'],
        ]);

        $company = Company::create(['name'=>'Default Company']);

        User::create([
            'name'=>'Super Admin',
            'email'=>'superadmin@example.com',
            'password'=>bcrypt('password'),
            'company_id'=>$company->id,
            'role_id'=>Role::where('name','SuperAdmin')->first()->id
        ]);
    }
}
