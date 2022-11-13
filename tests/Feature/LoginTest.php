<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     /** @test */
     public function UserCanLoginForm()
     {
         $response = $this->get('admin/login'); //User request URI (admin/login)

         $response->assertSuccessful(); //User request to URI successful

         $response->assertViewIs('backpack::auth.login'); //User can see a backpack login form
     }

     //This function use for test user can login

     /** @test */
     public function UserCanLogin()
     {
         $response = $this->post('/admin/login', //Make request user' email and password
             [
                 'email' => 'dev@dev.com',
                 'password' => '123456789'
             ]);

         $response->assertRedirect('/admin/dashboard'); //When request success it's redirect to admin dashboard
     }

     /** @test */
     public function UserCanLoginUsingFactory()
     {
         $user = factory(User::class)->create();

         $response = $this->post('/admin/login',
                [
                    'email' => $user->email,
                    'password' => '123456789'
                ]);

        $response->assertRedirect('/admin/dashboard');
     }


    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
