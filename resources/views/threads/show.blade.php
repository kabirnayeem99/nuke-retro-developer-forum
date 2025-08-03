@extends('threads.components.layout')

@section('title', 'Threads')

@section('content')
    <h2 style="font-size: 1.25rem; margin-bottom: 0.5rem;">{{ $thread->title }}</h2>
    <p style="color: #555; margin-bottom: 1rem;">{{ $thread->body }}</p>
    <p style="font-size: 0.875rem; color: #888;">
        Posted by {{ $thread->user->name }} — {{ $thread->created_at->diffForHumans() }}
    </p>

    <hr style="margin: 1.5rem 0;">

    <h3 style="font-size: 1rem; margin-bottom: 1rem;">Comments</h3>
    <ul style="list-style: none; padding-left: 0;">
        @foreach ($thread->posts as $post)
            <li style="margin-bottom: 1.5rem; border-left: 2px solid #ccc; padding-left: 1rem;">
                <p style="margin: 0 0 0.5rem;">{{ $post->body }}</p>
                <small style="color: #888;">
                    by {{ $post->user->name }} — {{ $post->created_at->diffForHumans() }}
                </small>
            </li>
        @endforeach
    </ul>



    @auth
        <div style="margin-top: 2rem;">
            <a href="{{ route('threads.create') }}">
                <button>
                    ➕ Create New Thread
                </button>
            </a>
        </div>
    @endauth
@endsection