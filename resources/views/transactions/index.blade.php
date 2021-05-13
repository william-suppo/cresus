@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900 mb-6">{{ __('Edit transactions') }}</h1>
    <div class="flex flex-wrap mb-2 bg-white rounded shadow p-4">
        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="effected_at">
                {{ __('Effected at') }}
            </label>
            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="effected_at" name="effected_at" type="date">
        </div>
        <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="label">
                {{ __('Label') }}
            </label>
            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="label" name="label" type="text" placeholder="{{ __('Shopping at ZuperMarket') }}">
        </div>
        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="debit_account_id">
                {{ __('Debit Account') }}
            </label>
            <div class="relative">
                <select class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="debit_account_id" name="debit_account_id">
                    <option>New Mexico</option>
                    <option>Missouri</option>
                    <option>Texas</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="credit_account_id">
                {{ __('Credit Account') }}
            </label>
            <div class="relative">
                <select class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="credit_account_id" name="credit_account_id">
                    <option>New Mexico</option>
                    <option>Missouri</option>
                    <option>Texas</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/12 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount">
                {{ __('Amount') }}
            </label>
            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="amount" name="amount" type="text" placeholder="15">
        </div>
        <div class="w-full md:w-1/12 px-3 mb-6 md:mb-0">
            <div class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">&nbsp;</div>
            <button class="block w-full bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold py-3 px-4 rounded" type="button">
                {{ __('Save') }}
            </button>
       </div>
    </div>

    <div class="mb-2 bg-white rounded shadow">
        <div class="px-8 py-6 font-bold uppercase text-gray-700">
            {{ __('Transactions order by date') }}
        </div>
        <table class="table-auto w-full">
            <thead class="uppercase text-gray-700 text-xs font-bold bg-gray-100 border-t border-gray-300 text-left">
                <tr>
                    <th class="pl-4 py-2">{{ __('Effected at') }}</th>
                    <th class="pl-4 py-2">{{ __('Label') }}</th>
                    <th class="pl-4 py-2">{{ __('Debit Account') }}</th>
                    <th class="pl-4 py-2">{{ __('Credit Account') }}</th>
                    <th class="pl-4 py-2">{{ __('Amount') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr class="border-t border-gray-300">
                        <td class="pl-4 py-4">{{ $transaction->effected_at }}</td>
                        <td class="pl-4 py-4">{{ $transaction->label }}</td>
                        <td class="pl-4 py-4">{{ $transaction->debitAccount->name }}</td>
                        <td class="pl-4 py-4">{{ $transaction->creditAccount->name }}</td>
                        <td class="pl-4 py-4">{{ $transaction->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
