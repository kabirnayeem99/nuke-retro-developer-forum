@extends('threads.components.layout')

@section('title', 'Threads')

@section('content')
    <div style="margin-bottom: 1rem;">
        @auth
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">
                    🚪 Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" style="text-decoration: none;">
                <button>
                    🔐 Log In
                </button>
            </a>
        @endauth
    </div>

    <p><strong>Threads</strong></p>

    @auth
        <div style="margin-bottom: 1rem;">
            <a href="{{ route('threads.create') }}" style="text-decoration: none;">
                <button>
                    ➕ Create New Thread
                </button>
            </a>
        </div>
    @endauth

    <ol class="threads-list">
        @foreach ($threads as $thread)
            <li>
                <a href="{{ route('threads.show', $thread->id) }}">
                    {{ $thread->title }}
                </a>
                <br>
                <small>
                    by {{ $thread->user->name }} — {{ $thread->created_at->diffForHumans() }}
                </small>
            </li>
        @endforeach
    </ol>
@endsection