<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body class="antialiased bg-gray-100 h-screen grid md:grid-cols-12" style="font-family: 'Roboto Condensed', sans-serif;">
        <aside class="bg-white md:col-span-2 border-r-4 border-secondary">
            <div class="w-full text-center py-8 text-3xl text-primary uppercase font-semibold">{{ config('app.name', 'Laravel') }}</div>
            <nav class="text-white">
                <a href="{{ route('dashboard.index') }}" class="{{ Request::is('dashboard*') ? 'bg-secondary opacity-100 text-white' : 'text-secondary' }} flex items-center hover:bg-secondary hover:text-white py-4 pl-6">
                    <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    {{ __('menu.dashboard') }}
                </a>
{{--                <a href="#" class="{{ Request::is('accounts*') ? 'bg-blue-800 opacity-100 text-blue-900' : '' }} flex items-center opacity-80 hover:opacity-100 hover:bg-gray-100 hover:text-blue-900 py-4 pl-6">--}}
{{--                    <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />--}}
{{--                    </svg>--}}
{{--                    {{ __('Accounts') }}--}}
{{--                </a>--}}
                <a href="{{ route('transactions.index') }}" class="{{ Request::is('transactions*') ? 'bg-secondary opacity-100 text-white' : 'text-secondary' }} flex items-center hover:bg-secondary hover:text-white py-4 pl-6">
                    <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                    {{ __('menu.transactions') }}
                </a>
            </nav>
        </aside>
        <div id="app" class="md:col-span-10">
            <header class="bg-white py-4 px-6 border-b-4 border-secondary flex flex-row-reverse">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a onclick="event.preventDefault(); this.closest('form').submit();" href="{{ route('logout') }}" class="inline-block py-2 px-4 text-white bg-secondary hover:bg-primary rounded">{{ __('auth.sign_out') }}</a>
                </form>
            </header>
            <main class="w-full p-8">
                @yield('content')
            </main>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
