<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortUrl extends Model
{
    protected $fillable = ['code','original_url','created_by','company_id','is_public'];
    public function creator(){ return $this->belongsTo(User::class,'created_by'); }
    public function company(){ return $this->belongsTo(Company::class); }

}
