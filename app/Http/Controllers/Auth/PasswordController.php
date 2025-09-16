<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('auth.editPassword');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();

        $updated = $user->update([
            'password' => Hash::make($request->password),
            'is_password_changed' => true,
            'plain_password' => 'Done',
        ]);


        if (!$updated) {
            return back()->withErrors(['password' => 'Gagal menyimpan password.']);
        }

        return redirect()->route('two-factor.setup')->with('success', 'Password berhasil diubah.');
    }

}
