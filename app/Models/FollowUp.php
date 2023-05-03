<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    protected $table = 'follow_ups';
    protected $fillable = [ 'customer_id', 'area_id', 'division_id', 'district_id', 'date', 
    'question1', 'question2', 'question3', 'question4', 'question5', 'comment' ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
}
