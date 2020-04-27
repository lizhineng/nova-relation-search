<?php

namespace LiZhineng\NovaRelationSearch\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}