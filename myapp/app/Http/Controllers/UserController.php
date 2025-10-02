<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // FORM
    public function loginForm()    { return view('auth.login'); }
    public function registerForm() { return view('auth.register'); }

    // ACTION: LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // ganti ke route tujuanmu
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // ACTION: REGISTER
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama'                  => 'required|string|max:150', // PENTING: kolom di DB kamu "nama"
            'email'                 => 'nullable|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'nama'     => $data['nama'],
            'email'    => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => 'bendahara',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard'); // ganti ke route tujuanmu
    }

    // ACTION: LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:150',
            'email'    => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:siswa,bendahara,admin',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:150',
            'email'    => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|string|in:siswa,bendahara,admin',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}
