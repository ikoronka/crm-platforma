<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CoachAuthController extends Controller
{
    /* ============ REGISTRACE ============ */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email',
                           Rule::unique((new Coach)->getTable())],
            'password' => ['required','confirmed',
                           Password::min(8)->letters()->numbers()],
        ]);

        $coach = Coach::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('coach')->login($coach);

        /* <-- ZELENÝ banner po úspěchu */
        return redirect()
               ->route('coach.dashboard')
               ->with('success', 'Vítej! Tvůj účet byl úspěšně vytvořen.');
    }

    /* ============ LOGIN ============ */
    public function login(Request $request)
    {
        $cred = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('coach')->attempt($cred, $request->boolean('remember'))) {

            $request->session()->regenerate();

            /* <-- ZELENÝ banner po úspěšném přihlášení */
            return redirect()
                   ->intended('/coach/dashboard')
                   ->with('success', 'Přihlášení proběhlo v pořádku.');
        }

        /* <-- ČERVENÝ banner při neplatných údajích */
        return back()
               ->withInput()
               ->with('error', 'Neplatné přihlašovací údaje.');
    }

    /* logout a další metody beze změn ... */
}
