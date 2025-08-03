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
        <form action="{{ route('threads.reply', ['thread' => $thread->id]) }}" method="POST"
            style="margin-top: 2rem; display: flex; flex-direction: column; gap: 0.5rem;">
            @csrf
            @if ($errors->any())
                <div style="color: #ff6b6b; font-family: monospace; margin-bottom: 0.5rem;">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">


            <textarea name="body" rows="4" placeholder="Write your reply here..." required
                style="padding: 6px 10px; font-family: monospace; font-size: 1rem; border: 1px solid #f2c57c; background: transparent; color: #f2c57c; border-radius: 3px; resize: vertical;"></textarea>



            <button type="submit">
                📝 Reply
            </button>
        </form>
    @endauth

@endsection