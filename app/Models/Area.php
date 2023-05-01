<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'areas';
    protected $fillable = [ 'name', 'address', 'district_id', 'deleted_at' ];

    //relation

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function customers(){
        return $this->hasMany(Customer::class);
    }
    
    public function users(){
        return $this->belongsToMany(User::class);
    }

}
