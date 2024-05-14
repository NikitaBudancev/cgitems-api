<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property $id
 * @property $name
 * @property $type
 * @property $model_id
 * @property $model_type
 * @property $model
 */
class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'model_id',
        'model_type',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
