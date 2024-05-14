<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'color', 'type', 'link', 'date_start', 'date_end', 'published'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

}
