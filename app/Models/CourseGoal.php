<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'goal_name',
        // thêm các trường khác nếu cần
    ];
}
