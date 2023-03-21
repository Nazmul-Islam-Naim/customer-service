<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'follow_ups';
    protected $fillable = [ 'customer_id', 'user_id', 'date_time', 'lat', 'long', 'avatar', 'note', 'deleted_at'];

    //relation

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followUpProduct(){
        return $this->hasMany(FollowUpProduct::class);
    }
}
