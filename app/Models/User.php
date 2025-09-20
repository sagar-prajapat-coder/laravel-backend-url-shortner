<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name','email','password','company_id','role_id'];

    protected $hidden = ['password'];



    public function isSuperAdmin(): bool
    {
        return $this->role && $this->role->name === 'SuperAdmin';
    }

    public function role(){ return $this->belongsTo(Role::class); }
    public function company(){ return $this->belongsTo(Company::class); }

}
