<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['email','role_id','company_id','invited_by'];
}
