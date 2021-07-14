<?php

namespace Tests\Unit;

use App\Services\Account;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /** @test */
    public function can_have_sum()
    {
        $account = new Account('Test');

        $account->amounts = [
            10, 5,
        ];

        $this->assertEquals(15, $account->getSum());
    }
}
