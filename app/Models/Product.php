<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['name', 'product_cat_id', 'deleted_at'];

    //relation
    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_cat_id');
    }
}
