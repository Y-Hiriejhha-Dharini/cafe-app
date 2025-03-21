<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function view()
    {
        return view('auth.login');
    }

    public function store(AuthRequest $request)
    {
        $validated_values = $request->validated();

           if(!Auth::attempt($validated_values)){
            throw ValidationException::withMessages([
                'email' => 'Provided credentials are not matched.'
            ]);
           }

           request()->session()->regenerate();
           return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return view('auth.login');
    }
}
