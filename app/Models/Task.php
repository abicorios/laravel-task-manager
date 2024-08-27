<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 * @method static where(string $string, mixed $id)
 * @property numeric user_id
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'done_at',
        'user_id',
        'task_category_id',
    ];

    public function task_category(): BelongsTo
    {
        return $this->belongsTo(TaskCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
