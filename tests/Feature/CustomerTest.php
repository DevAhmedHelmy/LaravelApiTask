<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
     /** @test */
    public function only_admin_can_create_customer()
    {
        // siginIN
        $this->siginIn();
        $this->post('/customers', $attributes = factory(\App\Customer::class)->raw(['user' => auth()->id()]));
    }
}
