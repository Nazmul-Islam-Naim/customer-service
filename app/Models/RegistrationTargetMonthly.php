<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationTargetMonthly extends Model
{
    use HasFactory;
    protected $table = 'registration_target_monthlies';
    protected $fillable = ['user_id','month','year','target','recovery'];

    //relation 

    public function user(){
        return $this->belongsTo(User::class);
    }
}
