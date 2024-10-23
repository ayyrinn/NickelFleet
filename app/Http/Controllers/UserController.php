<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('users.index', compact('users')); 
    }

    
    public function create()
    {
        return view('users.create'); 
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'role' => 'required|string',
        ]);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => $request->role,
            'level' => $request->level, 
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    
    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Mengembalikan tampilan untuk mengedit pengguna
    }

    
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Mengecualikan email pengguna yang sedang diedit
            'password' => 'nullable|string|min:8|confirmed', // Password boleh kosong
            'role' => 'required|string',
        ]);

        
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash password jika diisi
        }
        $user->role = $request->role;
        $user->level = $request->level; // Pastikan field level ada
        $user->save(); 

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    
    public function destroy(User $user)
    {
        $user->delete(); 
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
