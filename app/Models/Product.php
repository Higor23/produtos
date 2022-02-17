<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'cost', 'sale'];
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}