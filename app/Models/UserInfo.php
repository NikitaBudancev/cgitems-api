<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserInfo extends Model
{

    protected $fillable = [
        'avatar',
        'vk',
        'behance',
        'facebook',
        'artstation',
        'color_id',
        'user_id'
    ];

    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
            ->withDefault();
    }
}
