<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_root_redirects_to_the_login_page(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_the_login_page_is_available(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_authenticated_users_can_view_the_user_creation_form(): void
    {
        $this->actingAs(User::factory()->make())
            ->get('/users/create')
            ->assertOk()
            ->assertViewIs('users.create');
    }
}
