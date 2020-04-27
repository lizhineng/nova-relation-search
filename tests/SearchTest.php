<?php

namespace LiZhineng\NovaRelationSearch\Tests;

use LiZhineng\NovaRelationSearch\Tests\Fixtures\Post;

class SearchTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();

        $this->authenticate();
    }

    public function testItWorks()
    {
        factory(Post::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->withoutExceptionHandling()
            ->getJson('/nova-api/posts?search='.$post->user->name);

        $this->assertEquals($post->id, $response->original['resources'][0]['id']->value);

       $response->assertJsonCount(1, 'resources');
    }
}