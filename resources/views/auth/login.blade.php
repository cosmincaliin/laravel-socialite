<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
                
                <!-- Agregar botones de inicio de sesión con Google y Apple -->
                <div>
                    <a href="{{ url('login/google') }}" class="btn btn-danger">Login with Google</a>
                </div>

                <div>
                    <a href="{{ url('login/apple') }}" class="btn btn-success">Login with Apple</a>
                </div>
                <!-- Fin de botones de inicio de sesión con Google y Apple -->
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>