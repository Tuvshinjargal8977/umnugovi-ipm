<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\User;
use Tests\TestCase;

class AdminSmokeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Use the real dev database (seeded), not the in-memory test DB.
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => database_path('database.sqlite'),
        ]);
        \DB::purge('sqlite');
    }

    public function test_admin_and_front_pages_render(): void
    {
        $user = User::first() ?? User::factory()->create();
        $project = Project::published()->first();
        $post = Post::published()->first();
        $cat = PostCategory::first();

        $this->assertNotNull($project, 'no published project seeded');

        // Front
        $this->get('/')->assertOk();
        $this->get('/projects')->assertOk();
        $this->get('/projects/' . $project->slug)->assertOk();
        $this->get('/posts')->assertOk();
        $this->get('/search?q=' . urlencode('нисэх'))->assertOk();
        $this->get('/about-us')->assertOk();
        $this->get('/contact-us')->assertOk();
        $this->post('/contact-us', [
            'name' => 'Тест', 'email' => 't@example.com', 'body' => 'Сайн байна уу',
        ])->assertSessionHas('contact_sent');

        // Admin
        $this->actingAs($user);
        $this->get('/admin')->assertOk();
        $this->get('/admin/projects')->assertOk();
        $this->get('/admin/projects/create')->assertOk();
        $this->get('/admin/projects/' . $project->getRouteKey() . '/edit')->assertOk();
        $this->get('/admin/posts')->assertOk();
        $this->get('/admin/posts/create')->assertOk();
        $this->get('/admin/post-categories')->assertOk();
        $this->get('/admin/pages')->assertOk();
        $this->get('/admin/pages/create')->assertOk();
        $this->get('/admin/contact-messages')->assertOk();

        if ($post) {
            $this->get('/posts/' . $post->slug)->assertOk();
            $this->get('/admin/posts/' . $post->getRouteKey() . '/edit')->assertOk();
        }
        if ($cat) {
            $this->get('/admin/post-categories/' . $cat->getRouteKey() . '/edit')->assertOk();
        }
    }
}
