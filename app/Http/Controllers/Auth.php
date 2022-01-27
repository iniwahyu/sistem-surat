<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Library
use DB;
use Illuminate\Support\Facades\Hash;

// Load Model
use App\Models\UserModel;

class Auth extends Controller
{
    private $views      = '/auth';
    private $url        = "/auth";

    public function __construct()
    {
        $this->mUser = new UserModel();
    }

    public function login()
    {
        // Variable
        $title = 'Halaman Login';
        $url = $this->url;

        // Get Data

        // View
        return view("$this->views/login", compact('title', 'url'));
    }

    public function loginProses(Request $request)
    {
        // Check Request
        if ($request->only('username', 'password')) {
            // Get Data
            $users  = $this->mUser->where('username', $request->username)->first();
            
            // Check Data Exists
            if ($users == null) {
                return redirect()->back()->with('gagal', 'Akun Tidak Ditemukan');
            }
            
            // Check Password
            if (Hash::check($request->password, $users->password) == false) {
                return redirect()->back()->with('gagal', 'Password Salah');
            }

            // Set Session
            $setSession = [
                'users_id' => $users->id,
                'username' => $users->username,
                'role_id' => $users->role_id,
                'last_login' => $users->last_login,
            ];
            session($setSession);

            // Response
            return redirect("dashboard")->with('sukses', 'Berhasil Login');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect("login");
    }
}