@extends('auth.components.layout')

@section('title', 'Register')

@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-input label="Name" name="name" type="text" required autofocus />
        <x-input label="Email" name="email" type="email" required />
        <x-input label="Password" name="password" type="password" required />
        <x-input label="Confirm Password" name="password_confirmation" type="password" required />

        <button type="submit">🔒 Register</button>
    </form>

@endsection