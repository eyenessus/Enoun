@extends('layouts.login')
@section('titulo', 'Login')
@section('conteudo')

    <div class="container">

        <div class="m-md-5 p-md-5">
            <form class="row g-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded-3 m-3 mt-md-5 m-md-5 bg-light " method="POST"
                action="{{ route('login') }}">
                <h1 class=" p-md-3">Login</h1>
                @csrf
              
                
                <div class="mb-3">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                        autofocus />
                </div>

                <div class="mb-3">
                    <x-jet-label for="email" value="{{ __('Senha') }}" />
                    <input type="password" class="form-control" id="password" required autocomplete="current-password"
                        name="password">
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600 ">{{ __('Lembrar') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Esqueceu a senha?') }}
                        </a>
                    @endif

                    <div>
                        <button type="submit" class="btn btn-primary float-end " id="botaoenviar">Entrar</button>
                    </div>
                </div>


            </form>
        </div>

    </div>
@endsection
