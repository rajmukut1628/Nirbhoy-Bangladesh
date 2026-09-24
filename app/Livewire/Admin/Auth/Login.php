<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
            'role' => 'admin',
            'status' => 'active',
        ], $this->remember)) {

            throw ValidationException::withMessages([
                'email' => 'ইমেইল অথবা পাসওয়ার্ড সঠিক নয়।',
            ]);
        }

        request()->session()->regenerate();

        Auth::user()->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function render()
       {
    return view('livewire.admin.auth.login')
        ->layout('components.layouts.auth');
        }
}