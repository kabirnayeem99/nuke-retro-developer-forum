<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:3',
        ]);

        if (!Auth::attempt($attr)) {
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        return redirect()->route('feed')->with('status', 'Login successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'Logged out successfully!');
    }
}
