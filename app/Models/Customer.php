<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [ 'name', 'mobile', 'email', 'lat', 'long', 'address', 'avatar','division_id','district_id', 'area_id', 
    'priority_id', 'business_cat_id', 'user_id', 'date', 'deleted_at'];

    //relation
    
    public function businessCategory(){
        return $this->belongsTo(BusinessCategory::class,'business_cat_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
    
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
