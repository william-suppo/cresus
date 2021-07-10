<?php

namespace Tests\Feature\Bank;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cant_list_transactions()
    {
        $response = $this->get('/transactions');

        $response->assertRedirect('/');

        $response = $this->getJson('/ajax/transactions');

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_list_transactions()
    {
        Account::factory(28)->create();
        $transactions = Transaction::factory(5)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/transactions');

        $response->assertSuccessful();

        $response = $this->actingAs($user)->getJson('/ajax/transactions');

        $response->dump();
        $response->assertSuccessful()
            ->assertJson(function(AssertableJson $json) {
               $json->has('data', 5)
                   ->etc();
            });
    }
}
