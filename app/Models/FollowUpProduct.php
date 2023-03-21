<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpProduct extends Model
{
    use HasFactory;
    protected $table = 'follow_up_products';
    protected $fillable = [ 'follow_up_id', 'product_id' ];

    // relation

    public function followUp(){
        return $this->belongsTo(FollowUp::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
