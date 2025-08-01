@extends('feed.components.layout')

@section('title', 'Home')

@section('content')
    <p>
        Welcome to <strong>Nuke</strong>, the retro developer forum for those who miss the raw, underground internet.
    </p>

    <p>
        Dive into topics, threads, and conversations like it’s 1996 — but with modern power behind the scenes.
    </p>

    @auth
        <p>You’re logged in as <strong>{{ Auth::user()->name }}</strong>.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('DELETE')
            <button type="submit">🚪 Log Out</button>
        </form>
    @else
        <div style="margin-top: 1.5rem; display: flex; gap: 10px;">
            <a href="{{ route('login') }}">
                <button>🔒 Login</button>
            </a>
            <a href="{{ route('register') }}">
                <button>📝 Register</button>
            </a>
        </div>
    @endauth
@endsection