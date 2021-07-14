<?php

namespace App\Services;

use App\Models\Account as AccountModel;
use App\Models\Transaction as TransactionModel;
use Illuminate\Support\Carbon;

class Aggregator
{
    public function getByYear(int $year): Aggregate
    {
        $accounts = AccountModel::select('name')->orderBy('name')->get()->map(function ($account) {
            return new Account($account->name);
        });

        $aggregate = new Aggregate($accounts);

        for ($month = 1; $month <= 12; $month++) {
            $startedAt = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endedAt = Carbon::createFromDate($year, $month, 1)->endOfMonth();

            $transactions = TransactionModel::whereBetween('effected_at', [$startedAt, $endedAt])->get();

            $transactions->each(function ($transaction) use ($aggregate, $month) {
                $aggregate->subAmountToAccount($transaction->debitAccount->name, $month-1, $transaction->amount);
                $aggregate->addAmountToAccount($transaction->creditAccount->name, $month-1, $transaction->amount);
            });
        }

        return $aggregate;
    }
}
