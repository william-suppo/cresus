@extends('layouts.guest')

@section('content')
    <div class="flex min-h-screen text-white">
        <div class="flex flex-none justify-center md:w-1/4 w-full min-h-screen flex-1 bg-white">
            <div class="flex flex-col min-h-screen justify-center w-3/4">
                <h2 class="text-3xl text-primary font-extrabold my-8">{{ __('auth.sign_in_to_your_account') }}</h2>
                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="mt-4">
                        <x-label for="email" :value="__('auth.fields.email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" :value="__('auth.fields.password')" />
                        <x-input id="password" type="password" name="password" required autocomplete="current-password"/>
                    </div>

                    <div class="mt-4">
                        <button class="py-2 px-4 text-white bg-secondary hover:bg-primary rounded">
                            {{ __('auth.sign_in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="relative hidden flex-1 w-0 bg-white md:block">
            <img class="absolute inset-0 object-cover w-full h-full" alt="Background" src="/images/background.jpg">
        </div>
    </div>
@endsection
