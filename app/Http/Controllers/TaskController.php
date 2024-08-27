<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        $query = Task::query();

        if ($user->role !== 'ADMIN') {
            $query->where('user_id', auth()->id());
        }

        if ($request->has('task_category_id')) {
            $query->where('task_category_id', $request->input('task_category_id'));
        }

        $tasks = $query->get();
        return TaskResource::collection($tasks)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $data = $request->only(array_keys(StoreTaskRequest::rules()));
        $data['user_id'] = auth()->id();
        $task = Task::create($data);
        return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        return (new TaskResource($task))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $data = $request->only(array_keys(StoreTaskRequest::rules()));
        if ($request->has('done')) {
            if ($request->boolean('done')) {
                $data['done_at'] = now();
            } else {
                $data['done_at'] = null;
            }
        }
        $task->update($data);
        $task->refresh();
        return (new TaskResource($task))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
