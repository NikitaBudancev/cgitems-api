<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseProjectController extends Controller
{
    public function index(string $id)
    {
        return Course::with(['projects'])->findOrFail($id);
    }
}
