<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskCategory create(array $array)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskCategory find(int $id)
 * @property string name
 * @property string type
 */
class TaskCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
