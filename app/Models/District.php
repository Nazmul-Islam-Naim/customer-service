<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'districts';
    protected $fillable = [ 'division_id', 'name' , 'deleted_at' ];

    //relation

    public function division(){
        return $this->belongsTo(Division::class);
    }
}
