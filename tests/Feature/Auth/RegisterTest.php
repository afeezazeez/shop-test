<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_view_a_registration_form()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }


    public function test_user_can_register()
    {
        $faker=\Faker\Factory::create();
        $user= [
            'name' =>$faker->name,
            'email' => $faker->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $response = $this->post('/register',$user);

       $response->assertRedirect('/home');
        array_splice($user,2, 2);

        $this->assertDatabaseHas('users', $user);

    }


}
