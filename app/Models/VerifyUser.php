<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VerifyUser extends Model
{
    protected $guarded = [];
    protected $fillable= ['user_id','verify_token'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
