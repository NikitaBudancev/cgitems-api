<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Models\User;

class CourseUserController extends Controller
{
    public function index($id)
    {
        return User::whereRelation('projects', 'course_id', '=', $id)->get();
    }
}
