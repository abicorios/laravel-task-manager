<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskCategoryRequest;
use App\Http\Requests\UpdateTaskCategoryRequest;
use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class TaskCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskCategory::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $taskCategories = auth()->user()->task_categories;
        return response()->json($taskCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskCategoryRequest $request): JsonResponse
    {
        $taskCategory = TaskCategory::create(['name' => $request->str('name'), 'user_id' => auth()->id()]);
        return response()->json($taskCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskCategory $taskCategory): JsonResponse
    {
        return response()->json($taskCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskCategoryRequest $request, TaskCategory $taskCategory): JsonResponse
    {
        if ($request->has('name')) {
            if($request->str('name')) {
                $taskCategory->name = $request->str('name');
                $taskCategory->save();
            }
        }
        if ($request->has('user_id')) {
            if($request->str('user_id') && auth()->user()->isAdmin()) {
                User::findOrFail($request->str('user_id'));
                $taskCategory->user_id = $request->str('user_id');
                $taskCategory->save();
            }
        }
        return response()->json($taskCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskCategory $taskCategory): JsonResponse
    {
        $taskCategory->delete();
        return response()->json(['message' => 'Category deleted successfully'], 204);
    }
}
