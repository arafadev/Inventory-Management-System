<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'status', 'updated_by', 'created_by' ];

    

    public function product()
    {
        return $this->belongsTo(Product::class, 'unit_id', 'id');
    }


}