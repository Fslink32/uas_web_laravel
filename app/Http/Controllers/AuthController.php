<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WilayahProvinsiModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        // dd(auth()->check());
        if (auth()->check()) {
            return redirect()->route('admin.dashboard.index');
        } else {
            return view('auth.login');
        }
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth()->hasRole('member')) {
                return redirect()->route('user.home.index');
            } else {
                return redirect()->intended('dashboard')
                    ->withSuccess('Signed in');
            }
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember = ($request->input('username'))?true:false;
        if (Auth::attempt($credentials, $remember)) {
            if (auth()->user()->hasRole('member')) {
                return redirect()->route('user.home.index');
            } else {
                return redirect()->intended('dashboard')
                    ->withSuccess('Signed in');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        // dd($request->input());
        $is_exist = User::where(['email' => $request->input('email')])->get()->first();
        if ($is_exist) {
            Session::flash('message_error', 'Email sudah terdaftar');
            return view('auth.register');
        }
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_hp' => 'required',
            'username' => 'required',
        ]);
        $user = User::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'), [
                'rounds' => 8,
            ]),
            'phone' => $request->input('no_hp')
            // Set other additional data fields here
        ]);
        $user->assignRole('member');

        return view('auth.login');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Auth::logout();

        return Redirect('/');
    }

    public function validate_otp(Request $request)
    {
        $user_id = $request->input('user_id');
        $otp = $request->input('otp');
        $otp = implode('', $otp);

        $user = User::find(intval($user_id));
        if ($user->kode_otp == $otp) {
            User::where(['users.id' => $user_id])->update(['is_active' => 1]);
            return response('Berhasil', 200);
        } else {
            return response('Otp Tidak Sesuai', 422);
        }
    }
}
