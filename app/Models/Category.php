<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    const ACTIVE = '1';
    const INACTIVE = '0';

    protected $fillable = [
        'name',
        'description',
        'status',
        'category_id'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
