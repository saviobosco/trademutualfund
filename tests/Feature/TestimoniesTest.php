<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TestimoniesTest extends TestCase
{
    use DatabaseMigrations;

    public $testimonies;

    public function setUp()
    {
        parent::setUp();
        $this->signInAsAdmin();
        $this->testimonies = factory('App\Testimony', 5)->create();
    }

    /** @test */
    public function admin_can_view_all_testimonies()
    {
        $response = $this->get('/testimonies/index');
        $response->assertViewHas('testimonies');
        $response->assertViewIs('testimonies.index');
    }

    /** @test */
    public function admin_can_create_a_testimony()
    {
        $postData = [
            'testimony' => 'hello world what are there names',
            'user_id' => 1
        ];
        $response = $this->post('/testimonies/create', $postData);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'Testimony was successfully created created!');
    }

    /** @test */
    public function admin_can_edit_or_publish_testimony()
    {
        $postData = [
            'published' => 1,
            'default' => 1
        ];
        $response = $this->put('/testimonies/edit/'.$this->testimonies[0]['id'], $postData);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'Testimony updated');
    }
}
