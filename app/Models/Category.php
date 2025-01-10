<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     // Các thuộc tính có thể gán hàng loạt
     protected $fillable = [
        'category_name',
        'category_slug',
        'image',
    ];
    // In App\Models\Category.php
public function courses() {
    return $this->hasMany(Course::class);
}

}
