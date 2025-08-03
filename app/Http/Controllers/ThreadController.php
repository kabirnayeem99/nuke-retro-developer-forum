<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Jobs\GenerateRandomPosts;
use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Str;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads = Thread::latest()->paginate(10);
        $categories = Category::all();


        return view('threads.index', compact('threads', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadRequest $request)
    {
        $validated = $request->validated();

        $thread = Thread::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
        ]);

        GenerateRandomPosts::dispatch($thread);
        return redirect()->route('threads.show', $thread)->with('success', 'Thread created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
