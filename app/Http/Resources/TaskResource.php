<?php

namespace App\Http\Resources;

use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Task
 *
 * @property int id
 * @property string name
 * @property string description
 * @property int task_category_id
 * @property string created_at
 * @property string done_at
 */
class TaskResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'task_category' => TaskCategory::find($this->task_category_id)->name,
            'created_at' => $this->created_at,
            'status' => $this->done_at ? 'DONE' : 'IN_PROGRESS',
        ];
    }
}
