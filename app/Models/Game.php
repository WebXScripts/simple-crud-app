<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'appid',
        'name',
        'playtime_forever',
        'img_icon_url',
        'img_logo_url',
        'has_community_visible_stats'
    ];
}
