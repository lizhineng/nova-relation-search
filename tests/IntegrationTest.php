<?php

namespace LiZhineng\NovaRelationSearch\Tests;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Nova\Nova;
use LiZhineng\NovaRelationSearch\Tests\Fixtures\PostResource;
use Mockery;
use Orchestra\Testbench\TestCase;

abstract class IntegrationTest extends TestCase
{
    protected $authenticatedAs;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->withFactories(__DIR__.'/Factories');

        Nova::resources([
            PostResource::class,
        ]);

        Nova::auth(function () {
            return true;
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            \Laravel\Nova\NovaCoreServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function authenticate()
    {
        $this->actingAs($this->authenticatedAs = Mockery::mock(Authenticatable::class));

        $this->authenticatedAs->shouldReceive('getAuthIdentifier')->andReturn(1);
        $this->authenticatedAs->shouldReceive('getKey')->andReturn(1);

        return $this;
    }
}