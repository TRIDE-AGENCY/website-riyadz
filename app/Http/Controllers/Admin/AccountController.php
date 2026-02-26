<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $userId = auth()->guard('web')->user()->id;
        $user = User::find($userId);

        return inertia('Admin/Account/Index', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user = auth()->guard('web')->user();
        $request->validate([
            'name'             => 'required',
            'email'            => 'required|unique:users,email,' . $user->id,
            'current_password' => 'required_with:password',
            'password'         => 'nullable|confirmed|min:8',

        ], [
            'email.unique' => 'Email ini sudah digunakan, silakan pakai email lain.',
            'current_password.required_with' => 'Kata sandi lama wajib diisi jika ingin mengganti kata sandi baru.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi lama tidak sesuai.'])->withInput();
            }
        }

        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.account.index');
    }
}
