<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationTargetCurrent extends Model
{
    use HasFactory;
    protected $table = 'registration_target_currents';
    protected $fillable = ['user_id','month','year','target','recovery'];

    //relation 
    public function user(){
        return $this->belongsTo(User::class);
    }
}
