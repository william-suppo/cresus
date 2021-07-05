<?php

namespace App\Services;

use Illuminate\Support\Collection;

class AggregateEntity
{
    public function __construct(public Collection $accounts) {}

    public function subAmountForAccount(string $name, int $month, float $amount): void
    {
        $this->applyAmountForAccount($name, $month, -$amount);
    }

    public function addAmountForAccount(string $name, int $month, float $amount): void
    {
        $this->applyAmountForAccount($name, $month, $amount);
    }

    protected function applyAmountForAccount(string $name, int $month, float $amount): void
    {
        $account = $this->accounts->where('name', $name)->first();

        $account->amounts[$month] += $amount;
    }
}
