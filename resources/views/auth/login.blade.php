@extends('layouts.guest')

@section('content')
    <div class="flex min-h-screen text-white">
        <div class="flex flex-none justify-center md:w-1/4 w-full min-h-screen flex-1 bg-gray-800">
            <div class="flex flex-col min-h-screen justify-center w-3/4">
                <h2 class="text-3xl font-extrabold my-8">{{ __('Sign in to your account') }}</h2>
                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" type="password" name="password" required autocomplete="current-password"/>
                    </div>

                    <div class="mt-4">
                        <x-button>
                            {{ __('Sign in') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="relative hidden flex-1 w-0 bg-green-500 md:block">
            <img class="absolute inset-0 object-cover w-full h-full" alt="Background" src="/images/background.jpg">
        </div>
    </div>
@endsection
