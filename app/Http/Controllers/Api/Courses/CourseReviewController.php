<?php

namespace App\Http\Controllers\Api\Courses;

use App\Models\Project;

class CourseReviewController
{
    public function index() {
        return Project::where('review','<>', '')->get();
    }
}
