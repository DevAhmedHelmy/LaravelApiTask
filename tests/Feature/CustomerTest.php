<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use WithFaker, RefreshDatabase;
     /** @test */
    public function only_admin_can_create_customer()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
           $customer = factory(\App\Customer::class);
            $response = $this->actingAs($user, 'api')->json('POST', 'api/customers',$customer->toArray());
       
            $response->assertStatus(200)
             ->assertJson([
                'created' => true,
            ]);
    }
}
