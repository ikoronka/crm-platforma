<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    /** Zobrazí profil studenta */
    public function show(Request $request)
    {
        $student = $request->user('student');
        return view('student.profile', compact('student'));
    }

    /** Uloží změny profilu */
    public function update(Request $request)
    {
        $student = $request->user('student');

        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email',
                            Rule::unique('z_students')->ignore($student->id)],
            'birth_year' => ['required', 'integer', 'digits:4', 'between:1900,'.date('Y')],
            'password'   => ['nullable', 'confirmed',
                             Password::min(8)->letters()->numbers()],
        ]);

        $student->fill($data);

        if ($request->filled('password')) {
            $student->password = Hash::make($data['password']);
        }

        $student->save();

        return back()->with('success', 'Profil byl úspěšně aktualizován.');
    }
}
