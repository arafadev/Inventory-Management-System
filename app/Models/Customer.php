<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    
    // Scopes 
    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}