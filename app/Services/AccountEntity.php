<?php

namespace App\Services;

class AccountEntity
{
    public array $amounts = [];

    public function __construct(public string $name)
    {
        $this->amounts = array_fill(0, 12, 0);
    }

    public function getSum(): float
    {
        return array_sum($this->amounts);
    }
}
