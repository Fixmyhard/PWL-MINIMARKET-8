<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-full bg-gradient-to-br from-black via-gray-900 to-gray-800 text-white overflow-hidden pt-100">
        <!-- Custom Logo -->
        <div class="flex justify-center items-center mb-8 mt-6">
            <div class="flex items-center">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg">
                    <span class="text-2xl font-extrabold text-white">DJ</span>
                </div>
                <span class="ml-3 text-3xl font-bold text-red-500">DEJAYMARKET</span>
            </div>
        </div>


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class=" p-4 bg-gray-920/90 rounded-lg shadow-lg">
            <h1 class="text-xl font-bold text-center mb-9">Login to {{ config('app.name', 'DEJAYMARKET') }}</h1>
        
            <form method="POST" action="{{ route('login') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="mb-1">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-400" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-800 text-white border-gray-600 focus:border-red-500 focus:ring-red-500" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500" />
                </div>
        
                <!-- Password -->
                <div class="mb-3">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-400" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-800 text-white border-gray-600 focus:border-red-500 focus:ring-red-500" 
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500" />
                </div>
        
                <!-- Remember Me -->
                <div class="flex items-center mb-3">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-gray-800 border-gray-600 text-red-500 focus:ring-red-500" name="remember">
                        <span class="ml-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
        
                <!-- Forgot Password & Login Button -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-500 hover:text-red-700 underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
        
                    <x-primary-button class="ml-4 bg-red-500 hover:bg-red-600 border-none focus:ring-red-500">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>        

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Prevent scrolling */
            font-family: 'Arial', sans-serif;
        }
    </style>
</x-guest-layout>
