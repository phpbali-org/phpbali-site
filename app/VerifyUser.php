<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = [];
    protected $fillable= ['user_id','verify_token'];
    
    public function user(){
        return $this->belongsTo("App\User");
    }
}
