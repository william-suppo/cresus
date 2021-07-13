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
    public function user_can_list_transactions()
    {
        Account::factory(28)->create();
        Transaction::factory(5)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/transactions');

        $response->assertSuccessful();

        $response = $this->actingAs($user)->getJson('/transactions/getAllPaginate');

        $response
            ->assertSuccessful()
            ->assertJson(function(AssertableJson $json) {
               $json->has('data', 5)
                   ->etc();
            });
    }

    /** @test */
    public function guest_cant_list_transactions()
    {
        $response = $this->get('/transactions');

        $response->assertRedirect('/');

        $response = $this->getJson('/transactions/getAllPaginate');

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_create_transaction()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/transactions', [
            'label' => 'HAPPY NEW YEAR',
            'effected_at' => '2021-01-01',
            'amount' => 2021,
            'debit_account_name' => 'Comptes::John',
            'credit_account_name' => 'Dépenses::Loisir',
        ]);

        $response
            ->assertSuccessful()
            ->assertJson(function(AssertableJson $json) {
                $json->has('data', function (AssertableJson $json) {
                    $json->where('label', 'HAPPY NEW YEAR')
                        ->etc();
                });
            });

        $this->assertDatabaseCount('transactions', 1);
        $this->assertDatabaseHas('transactions', [
            'label' => 'HAPPY NEW YEAR',
        ]);

        $this->assertDatabaseCount('accounts', 2);
        $this->assertDatabaseHas('accounts', [
            'name' => 'Comptes::John',
        ]);
        $this->assertDatabaseHas('accounts', [
            'name' => 'Dépenses::Loisir',
        ]);
    }

    /** @test */
    public function guest_cant_create_transaction()
    {
        $response = $this->postJson('/transactions', [
            'label' => 'H4CK3R',
            'effected_at' => '2021-01-01',
            'amount' => 100000,
            'debit_account_name' => 'Comptes::John',
            'credit_account_name' => 'Dépenses::Ransomware',
        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_edit_transaction()
    {
        $debitAccount = Account::factory()->create([
            'name' => 'Comptes::John',
        ]);
        $creditAccount = Account::factory()->create([
            'name' => 'Dépenses::Cadeau',
        ]);
        $transaction = Transaction::factory()->create([
            'label' => 'SECRET GIFT',
            'debit_account_id' => $debitAccount->id,
            'credit_account_id' => $creditAccount->id,
        ]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson('/transactions/' . $transaction->id, [
            'effected_at' => '2021-01-01',
            'label' => '****',
            'amount' => 2021,
            'debit_account_name' => 'Comptes::John',
            'credit_account_name' => 'Dépenses::Cadeau',
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseCount('transactions', 1);
        $this->assertDatabaseHas('transactions', [
            'label' => '****',
        ]);

        $this->assertDatabaseCount('accounts', 2);
    }

    /** @test */
    public function guest_cant_edit_transaction()
    {
        Account::factory(2)->create();
        $transaction = Transaction::factory()->create();

        $response = $this->putJson('/transactions/' . $transaction->id, [
            'label' => 'H4CK3R',
            'effected_at' => '2021-01-01',
            'amount' => 100000,
            'debit_account_name' => 'Comptes::John',
            'credit_account_name' => 'Dépenses::Ransomware',
        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_delete_transaction()
    {
        Account::factory(2)->create();
        $transaction = Transaction::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/transactions/' . $transaction->id);

        $response->assertSuccessful();

        $this->assertDatabaseCount('transactions', 0);
    }

    /** @test */
    public function guest_cant_delete_transaction()
    {
        Account::factory(2)->create();
        $transaction = Transaction::factory()->create();

        $response = $this->deleteJson('/transactions/' . $transaction->id);

        $response->assertUnauthorized();
    }
}
