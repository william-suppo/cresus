<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Database\Query\Builder;

class AggregateService
{
    public function getByYear(int $date): array
    {
        $accounts = Account::whereHas('transactions', function (Builder $query) {
            $query->where('effected_at', '>=', '2021-01-01')
                ->where('effected_at', '<=', '2021-01-31');
        })->get();


        dd($accounts);

//        return [
//            'jan' => [
//                'Compte:Wil' => 522,
//                'Compte:Angel' => 354,
//            ],
//            'feb' => [
//                'Compte:Wil' => 100,
//                'Dépenses:Info' => 415,
//            ],
//            'total' => [
//                'Compte:Wil' => 622,
//                'Compte:Angel' => 354,
//                'Dépenses:Info' => 415,
//            ],
//        ];
    }
}
