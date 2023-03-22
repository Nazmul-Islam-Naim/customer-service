<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['name', 'business_cat_id', 'deleted_at'];

    //relation
    public function businessCategory(){
        return $this->belongsTo(BusinessCategory::class, 'business_cat_id');
    }

    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
