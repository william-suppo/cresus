<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\Aggregator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AggregatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_have_statistics_by_year()
    {
        $debitAccount = Account::factory()->create([
            'name' => 'Comptes:Mario'
        ]);
        $creditAccount = Account::factory()->create([
            'name' => 'Comptes:Zelda'
        ]);
        Transaction::factory()->create([
            'label' => 'First Gift',
            'effected_at' => '2002-11-22',
            'amount' => 1989,
            'debit_account_id' => $debitAccount->id,
            'credit_account_id' => $creditAccount->id,
        ]);
        Transaction::factory()->create([
            'label' => 'Another Gift',
            'effected_at' => '2002-12-13',
            'amount' => 11,
            'debit_account_id' => $debitAccount->id,
            'credit_account_id' => $creditAccount->id,
        ]);
        Transaction::factory()->create([
            'label' => 'Another Year, another Gift',
            'effected_at' => '2005-01-25',
            'amount' => 69,
            'debit_account_id' => $debitAccount->id,
            'credit_account_id' => $creditAccount->id,
        ]);

        $aggregator = new Aggregator();

        $aggregate = $aggregator->getByYear(2002);

        $this->assertCount(2, $aggregate->accounts);

        $debitAccountActual = $aggregate->accounts->where('name', 'Comptes:Mario')->first();

        $this->assertEquals(-1989, $debitAccountActual->amounts[10]);
        $this->assertEquals(-11, $debitAccountActual->amounts[11]);
        $this->assertEquals(-2000, $debitAccountActual->getSum());

        $creditAccountActual = $aggregate->accounts->where('name', 'Comptes:Zelda')->first();

        $this->assertEquals(1989, $creditAccountActual->amounts[10]);
        $this->assertEquals(11, $creditAccountActual->amounts[11]);
        $this->assertEquals(2000, $creditAccountActual->getSum());

        $aggregate = $aggregator->getByYear(2005);

        $this->assertCount(2, $aggregate->accounts);

        $debitAccountActual = $aggregate->accounts->where('name', 'Comptes:Mario')->first();

        $this->assertEquals(-69, $debitAccountActual->amounts[0]);
        $this->assertEquals(-69, $debitAccountActual->getSum());

        $creditAccountActual = $aggregate->accounts->where('name', 'Comptes:Zelda')->first();

        $this->assertEquals(69, $creditAccountActual->amounts[0]);
        $this->assertEquals(69, $creditAccountActual->getSum());
    }
}
