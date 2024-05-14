<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $name,
 * @property $slug,
 * @property $project_description,
 * @property $title,
 * @property $keywords,
 * @property $description,
 * @property $published,
 * @property $review,
 * @property $review_date,
 * @property $course_id,
 * @property $current_stage_id,
 * @property $project_type_id,
 * @property $user_id
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'project_description',
        'title',
        'keywords',
        'description',
        'published',
        'review',
        'review_date',
        'course_id',
        'current_stage_id',
        'project_type_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function stage(): belongsTo
    {
        return $this->belongsTo(ProjectStage::class, 'current_stage_id');
    }

    public function stages(): HasMany
    {
        return $this->hasMany(ProjectStage::class);
    }
}
