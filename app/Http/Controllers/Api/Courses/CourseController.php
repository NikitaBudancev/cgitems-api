<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Courses\StoreRequest;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->authorize('create', Course::class);

            $course = Course::create($request->all());

            return response()->json([
                'data' => $course,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Course::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->authorize('update', Course::class);

            $course = Course::findOrFail($id);
            $course->update($request->all());

            return response()->json([
                'data' => $course,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->authorize('delete', Course::class);

            $courseDeleted = Course::destroy($id);

            return response()->json([
                'data' => [
                    'id' => $id,
                    'isDelete' => $courseDeleted,
                ],
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!',
            ], 500);
        }
    }
}
