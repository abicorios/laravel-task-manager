<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * User
 *
 * @property string email
 * @property int id
 * @property array task_categories
 * @method tasks()
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
        $task_categories = $this->task_categories;
        foreach ($task_categories as $task_category) {
            $task_count = $task_category->tasks()->where('user_id', $this->id)->count();
            $result[] = [
                'email' => $this->email,
                'name' => $task_category->name,
                'task_count' => $task_count,
            ];
        }
        return $result;
    }
}
