<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function createUser()
    {
        $name = 'John Doe';
        $email = 'john@example.com';
        $password = 'password';

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return 'User created';
    }
    public function auth(Request $req) {
        if (Auth::attempt(['email'=>$req->em, 'password'=>$req->pwd])) {
            return redirect('/products');
        }
        return redirect('/login')->with('msg', 'Email / password salah');
    }
}
