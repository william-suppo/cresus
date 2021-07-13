<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function getAllPaginate(): AnonymousResourceCollection
    {
        return TransactionResource::collection(
            Transaction::with(['debitAccount', 'creditAccount'])
                ->orderByDesc('effected_at')
                ->paginate(50)
        );
    }

    public function store(Request $request): TransactionResource
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

    public function update(Transaction $transaction, Request $request): Response
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

        $transaction->update($properties);

        return response()->noContent();
    }

    public function destroy(Transaction $transaction): Response
    {
        $transaction->delete();

        return response()->noContent();
    }
}
