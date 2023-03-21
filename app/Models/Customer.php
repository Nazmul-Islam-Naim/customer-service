<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [ 'name', 'mobile', 'email', 'lat', 'long', 'address', 'avatar', 'priority_id', 'business_cat_id', 'area_id', 'user_id', 'date', 'deleted_at'];

    //relation
    
    public function businessCategory(){
        return $this->belongsTo(BusinessCategory::class,'business_cat_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
