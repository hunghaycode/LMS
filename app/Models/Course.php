<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class, 'category_id' ,'id');
    }
    public function course_goals()
    {
        return $this->hasMany(CourseGoal::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'instructor_id' ,'id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id' ,'id');
    }

}
