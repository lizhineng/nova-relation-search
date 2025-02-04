<?php

namespace LiZhineng\NovaRelationSearch\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}