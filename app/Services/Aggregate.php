<?php

namespace App\Services;

use Illuminate\Support\Collection;

class Aggregate
{
    public function __construct(public Collection $accounts) {}

    public function subAmountToAccount(string $name, int $month, float $amount): void
    {
        $this->applyAmountToAccount($name, $month, -$amount);
    }

    public function addAmountToAccount(string $name, int $month, float $amount): void
    {
        $this->applyAmountToAccount($name, $month, $amount);
    }

    protected function applyAmountToAccount(string $name, int $month, float $amount): void
    {
        $account = $this->accounts->where('name', $name)->first();

        $account->amounts[$month] += $amount;
    }
}
