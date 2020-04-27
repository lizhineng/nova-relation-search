<?php

namespace LiZhineng\NovaRelationSearch\Tests\Fixtures;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Resource;
use LiZhineng\NovaRelationSearch\HandleRelationSearch;

class PostResource extends Resource
{
    use HandleRelationSearch;

    public static $model = Post::class;

    public static $search = [
        'id',
        'title',
    ];

    public static $relationSearch = [
        'user' => ['name'],
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(),

            BelongsTo::make('User', 'user', UserResource::class),
        ];
    }

    public static function uriKey()
    {
        return 'posts';
    }
}