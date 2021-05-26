@extends('layouts/app')

@section('nav')@endsection

@section('first_section')
    <div class="container is-max-desktop" style="max-width: 23em; margin-top: 4em;">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Login
                </p>
            </header>
            <div class="card-content">
                <div class="content" style="width: 20em;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field">
                            <input name="username" value="{{ old('username') }}" class="input" type="text" placeholder="username">

                            @error('username')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <input name="password" class="input" type="password" placeholder="password">

                            @error('password')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="button is-danger" type="submit">Login</button>

                        <br /><br />
                        <a href="{{ route('register') }}" class="is-block is-light is-size-7" type="submit">Sign Up</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
