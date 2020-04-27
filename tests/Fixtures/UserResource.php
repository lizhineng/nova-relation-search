<?php

namespace LiZhineng\NovaRelationSearch\Tests\Fixtures;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

class UserResource extends Resource
{
    public static $model = User::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(),

            Text::make('Name'),
        ];
    }

    public static function uriKey()
    {
        return 'users';
    }
}