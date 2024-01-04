<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVerify extends Model
{
    use HasFactory;

    public $table = "user_verifies";
    protected $fillable = [
        'user_id',
        'token',
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
