@extends('layouts.app')

@section('content')
    <div class="w-full mt-10">
        <div class="w-full bg-white rounded shadow-lg p-8">
            <span class="block w-full text-xl uppercase font-bold mb-4">{{ __('Register') }}</span>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4 md:w-full">
                    <label for="name" class="block text-xs mb-1">Name</label>
                    <input id="name" type="name" class="w-full border rounded p-2 outline-none focus:shadow-outline"
                        name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6 md:w-full">
                    <label for="email" class="block text-xs mb-1">Email</label>
                    <input id="email" type="email" class="w-full border rounded p-2 outline-none focus:shadow-outline"
                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6 md:w-full">
                    <label for="password" class="block text-xs mb-1">Password</label>
                    <input id="password" type="password" class="w-full border rounded p-2 outline-none focus:shadow-outline"
                        name="password" autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6 md:w-full">
                    <label for="password-confirmation" class="block text-xs mb-1">Password Confirmation</label>
                    <input id="password-confirmation" type="password"
                        class="w-full border rounded p-2 outline-none focus:shadow-outline" name="password_confirmation"
                        autocomplete="current-password">
                </div>
                <div class="mb-6 md:w-full">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <button
                    class="bg-yellow-500 hover:bg-yellow-700 text-white uppercase text-sm font-semibold px-4 py-2 rounded">{{ __('Register') }}</button>
            </form>
        </div>
    </div>
@endsection
