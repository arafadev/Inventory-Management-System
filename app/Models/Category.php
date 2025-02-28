<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];



    // Scopes 
    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

}