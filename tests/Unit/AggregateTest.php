<?php

use App\Services\Account;
use App\Services\Aggregate;
use Tests\TestCase;

class AggregateTest extends TestCase
{
    /** @test */
    public function can_apply_amount_to_account()
    {
        $accounts = collect([
            $debitAccount = new Account('Comptes:Mario'),
            $creditAccount = new Account('Comptes:Zelda'),
        ]);

        $aggregate = new Aggregate($accounts);

        $aggregate->subAmountToAccount($debitAccount->name, 0, 50);
        $aggregate->addAmountToAccount($creditAccount->name, 0, 50);

        $this->assertEquals(-50, $debitAccount->getSum());
        $this->assertEquals(50, $creditAccount->getSum());
    }
}
