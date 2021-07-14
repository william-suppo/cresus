<?php

namespace Tests\Feature\Bank;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_show()
    {
        $debitAccount = Account::factory()->create([
            'name' => 'Comptes:Johnson'
        ]);
        $creditAccount = Account::factory()->create([
            'name' => 'Dépense:Loisir'
        ]);
        Transaction::factory()->create([
            'label' => 'Holidays',
            'effected_at' => '2021-01-01',
            'amount' => 50,
            'debit_account_id' => $debitAccount->id,
            'credit_account_id' => $creditAccount->id,
        ]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertSuccessful()
            ->assertSeeText('Statistics of the year 2021')
            ->assertSee($debitAccount->name)
            ->assertSee($creditAccount->name);
    }

    /** @test */
    public function guest_cant_show()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/');
    }
}
