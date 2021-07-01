<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class Aggregator
{
    public function getByYear(int $year): AggregateEntity
    {
        $accounts = Account::select('name')->orderBy('name')->get()->map(function ($account) {
            return new AccountEntity($account->name);
        });

        $aggregate = new AggregateEntity($accounts);

        for ($month = 1; $month <= 12; $month++) {
            $startedAt = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endedAt = Carbon::createFromDate($year, $month, 1)->endOfMonth();

            $transactions = Transaction::whereBetween('effected_at', [$startedAt, $endedAt])->get();

            $transactions->each(function ($transaction) use ($aggregate, $month) {
                $aggregate->subAmountForAccount($transaction->debitAccount->name, $month-1, $transaction->amount);
                $aggregate->addAmountForAccount($transaction->creditAccount->name, $month-1, $transaction->amount);
            });
        }

        return $aggregate;
    }
}
