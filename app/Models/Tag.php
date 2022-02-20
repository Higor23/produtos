<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

     protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })
            ->paginate();

        return $results;
    }
}
