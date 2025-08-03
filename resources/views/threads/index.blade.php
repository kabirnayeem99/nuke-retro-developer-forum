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

    <ul class="threads-list" style="padding-left: 0rem; list-style: none;">
        @foreach ($threads as $thread)
            <li style="margin-bottom: 1.5rem;">
                <strong>{{ $thread->id }}.</strong>
                <a href="{{ route('threads.show', $thread->id) }}">
                    {{ $thread->title }}
                </a>
                <br>
                <small>
                    by {{ $thread->user->name }} — {{ $thread->created_at->diffForHumans() }}
                </small>
            </li>
        @endforeach
    </ul>

    {{ $threads->links('pagination::simple-default') }}

    @auth
        <form action="{{ route('threads.store') }}" method="POST"
            style="margin-bottom: 1rem; display: flex; flex-direction: column; gap: 0.5rem;">
            @csrf
            <input type="text" name="title" placeholder="Enter thread title..." required
                style="padding: 6px 10px; font-family: monospace; font-size: 1rem; border: 1px solid #f2c57c; background: transparent; color: #f2c57c; border-radius: 3px;">
            <textarea name="body" placeholder="Enter thread body..." required rows="4"
                style="padding: 6px 10px; font-family: monospace; font-size: 1rem; border: 1px solid #f2c57c; background: transparent; color: #f2c57c; border-radius: 3px; resize: vertical;"></textarea>
            <select name="category_id" required
                style="padding: 6px 10px; font-family: monospace; font-size: 1rem; border: 1px solid #f2c57c; background: transparent; color: #f2c57c; border-radius: 3px;">
                <option value="" disabled selected>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit">
                ➕ Create
            </button>
        </form>
    @endauth
@endsection