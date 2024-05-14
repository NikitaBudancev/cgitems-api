<?php

namespace App\Models;

use App\Contracts\Media\MediaFileContract;
use App\Traits\Media\HasImageFile;
use App\Traits\Media\HasMediaFile;
use App\Traits\Media\HasPreviewFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectStage extends Model implements MediaFileContract
{
    use HasFactory;
    use HasImageFile;
    use HasMediaFile;
    use HasPreviewFile;

    protected $fillable = [
        'stage_id',
        'project_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
}
