@extends('auth.components.layout')

@section('title', 'Login') {{-- or 'Register' --}}

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-input label="Email" name="email" type="email" required autofocus />
        <x-input label="Password" name="password" type="password" required />

        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label><br><br>

        <button type="submit">🔒 Enter</button>
    </form>

    <form action="{{ route('register') }}" method="get">
        <button type="submit">📝 Register</button>
    </form>
@endsection