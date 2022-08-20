<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @method static create(array $all)
 * @method static orderBy(string $string, string $string1)
 * @property mixed $views_count
 */
class Todo extends Model
{
    protected $fillable = ['name','user_id' ,'description','project_id','state'];
    use HasFactory;
    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }
    public function project()
    {

        return $this->belongsTo(Project::class);
    }
}
