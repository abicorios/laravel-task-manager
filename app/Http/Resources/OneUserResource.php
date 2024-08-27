<?php

namespace App\Http\Resources;

use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * User
 *
 * @property string email
 * @property int id
 * @method tasks()
 * @method task_categories()
 */
class OneUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [];
        $task_categories = TaskCategory::all();
        foreach ($task_categories as $task_category) {
            $task_count = $task_category->tasks()->where('user_id', $this->id)->count();
            if ($task_count > 0) {
                $result[] = [
                    'email' => $this->email,
                    'name' => $task_category->name,
                    'task_count' => $task_count,
                ];
            }
        }
        return $result;
    }
}
