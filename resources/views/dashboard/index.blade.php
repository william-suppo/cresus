@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900 mb-6">Dashboard</h1>

    <div class="mb-2 bg-white rounded shadow">
        <div class="flex items-center justify-between px-8 py-6">
            <h3 class="font-bold uppercase text-gray-700">
                2021
            </h3>
        </div>
        <table class="table-fixed w-full">
            <thead class="uppercase text-gray-700 text-xs font-bold bg-gray-100 border-t border-gray-300 text-left">
                <tr>
                    <th class="text-center py-2 w-1/6">&nbsp;</th>
                    <th class="text-center py-2 w-1/12">Janvier</th>
                    <th class="text-center py-2 w-1/12">Février</th>
                    <th class="text-center py-2 w-1/12">Mars</th>
                    <th class="text-center py-2 w-1/12">Avril</th>
                    <th class="text-center py-2 w-1/12">Mai</th>
                    <th class="text-center py-2 w-1/12">Juin</th>
                    <th class="text-center py-2 w-1/12">Juillet</th>
                    <th class="text-center py-2 w-1/12">Aout</th>
                    <th class="text-center py-2 w-1/12">Septembre</th>
                    <th class="text-center py-2 w-1/12">Octobre</th>
                    <th class="text-center py-2 w-1/12">Novembre</th>
                    <th class="text-center py-2 w-1/12">Décembre</th>
                    <th class="text-center py-2 w-1/12">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aggregate->accounts as $account)
                    <tr class="border-t border-gray-300">
                        <td class="pl-4 py-3 text-sm">{{ $account->name }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->amounts[0], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right">{{ number_format($account->amounts[1], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->amounts[2], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right">{{ number_format($account->amounts[3], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->amounts[4], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right">{{ number_format($account->amounts[5], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->amounts[6], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right">{{ number_format($account->amounts[7], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->amounts[8], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right">{{ number_format($account->amounts[9], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->amounts[10], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right">{{ number_format($account->amounts[11], 2, ',') }}</td>
                        <td class="pr-4 py-3 text-sm text-right bg-blue-100">{{ number_format($account->getSum(), 2, ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
