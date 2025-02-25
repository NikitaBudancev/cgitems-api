<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'color_id',
    ];
}
