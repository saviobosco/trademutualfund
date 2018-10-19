<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/4/18
 * Time: 10:49 AM
 */

namespace tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Http\Middleware\EnsurePhoneIsVerified;


class ProfileTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->withoutMiddleware([EnsurePhoneIsVerified::class]);

    }

    /** @test */
    public function a_user_can_view_profile()
    {
        $response = $this->get('/profile/view');
        $response->assertSuccessful();
        $response->assertViewHas('user');
        $response->assertViewHas('countries');
    }

    /** @test */
    public function a_user_can_update_profile()
    {
        $update = ['name' => 'Omebe Johnbosco'];
        $response = $this->put('/profile/edit', $update);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'Your details has been updated');
        $this->assertDatabaseHas('users', [
            'name' => $update['name']
        ]);
    }

    /** @test */
    public function a_user_can_update_settings()
    {
        $update = ['email_notification' => 1];
        $response = $this->put('/profile/update_settings', $update);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'settings was successfully updated');
        $this->assertDatabaseHas('user_settings', [
            'email_notification' => $update['email_notification']
        ]);
    }

    /** @test */
    public function a_user_can_change_password()
    {
        $update = [
            'current_password' => 'secret',
            'password' => 'admin360',
            'password_confirmation' => 'admin360'
        ];
        $response = $this->put('/profile/change_password', $update);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'password was successfully updated!');
    }

    /** @test */
    public function a_user_update_payment_info()
    {
        $update = [
            'account_name' => 'admin admin',
        ];
        $response = $this->put('/profile/update_payment_info', $update);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'Your details has been updated');
        $this->assertDatabaseHas('user_payment_details', [
            'account_name' => $update['account_name']
        ]);
    }

}