<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->signInAsAdmin();
    }

    /** @test */
    public function an_admin_can_view_all_users()
    {
        $response = $this->get('/users/index');
        $response->assertViewHas('users');
        $response->assertViewIs('users.index');
        $response->assertSuccessful();
        $response->assertSee(auth()->user()->name);
    }

    /** @test */
    public function an_admin_can_view_user_profile()
    {
        $user = factory('App\User')->create();
        $response = $this->get('/users/view/'.$user->id);
        $response->assertViewHas('user');
        $response->assertViewIs('users.view');
        $response->assertSuccessful();
        $response->assertSee($user->name);
    }

    /** @test */
    public function admin_can_update_user_profile()
    {
        $user = factory('App\User')->create();
        $response = $this->put('/users/edit/'.$user->id);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'User record has been updated');
    }
}
