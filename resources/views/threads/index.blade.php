@extends('threads.components.layout')

@section('title', 'Threads')

@section('content')
    <p><strong>Threads</strong></p>

    <ol style="padding-left: 1.25rem;">
        @foreach ($threads as $thread)
            <li style="margin-bottom: 0.5rem;">
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

    @auth
        <div style="margin-top: 2rem;">
            <a href="{{ route('threads.create') }}">
                <button>➕ Create New Thread</button>
            </a>
        </div>
    @endauth
@endsection