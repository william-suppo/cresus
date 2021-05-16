<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return TransactionResource::collection(Transaction::with(['debitAccount', 'creditAccount'])->limit(30)->orderByDesc('effected_at')->get());
    }

    public function save(Request $request)
    {
        $debitAccount = Account::firstOrCreate(['name' => $request->get('debit_account_name')]);
        $creditAccount = Account::firstOrCreate(['name' => $request->get('credit_account_name')]);

        $properties = [
            'effected_at' => $request->get('effected_at'),
            'label' => $request->get('label'),
            'amount' => $request->get('amount'),
            'debit_account_id' => $debitAccount->id,
            'credit_account_id' => $creditAccount->id,
        ];

        $transaction = Transaction::create($properties);

        return new TransactionResource($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->noContent();
    }
}
