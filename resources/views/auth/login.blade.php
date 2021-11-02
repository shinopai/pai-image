@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <div class="w-full mt-10">
        <div class="w-full bg-white rounded shadow-lg p-8">
            <span class="block w-full text-xl uppercase font-bold mb-4">{{ __('Login') }}</span>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4 md:w-full">
                    <label for="email" class="block text-xs mb-1">Email</label>
                    <input id="email" type="email" class="w-full border rounded p-2 outline-none focus:shadow-outline"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6 md:w-full">
                    <label for="password" class="block text-xs mb-1">Password</label>
                    <input id="password" type="password" class="w-full border rounded p-2 outline-none focus:shadow-outline"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6 md:w-full">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <button
                    class="bg-yellow-500 hover:bg-yellow-700 text-white uppercase text-sm font-semibold px-4 py-2 rounded">{{ __('Login') }}</button>
            </form>
            @if (Route::has('password.request'))
                <a class="text-blue-700 text-center text-sm"
                    href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            @endif
        </div>
    </div>
@endsection
