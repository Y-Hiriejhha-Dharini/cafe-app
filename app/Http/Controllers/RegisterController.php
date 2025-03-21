<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function view()
    {
        return view('auth.register');
    }
    public function store(RegisterRequest $request)
    {
        $validated_user = $request->validated();
        $user = User::create($validated_user);
        Auth::login($user);
        return redirect()->route('client.index');
    }
}
