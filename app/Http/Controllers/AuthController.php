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
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate(false);
            return redirect()->route('admin.dashboard.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registration($role = null)
    {
        if (empty($role)) {
            return redirect()->route('login');
        }
        $provinsi = WilayahProvinsiModel::get();
        return view('auth.register', ['role' => $role, 'provinsi' => $provinsi]);
    }

    public function customRegistration(Request $request)
    {
        $is_exist = User::where(['email' => $request->input('email')])->get()->first();
        if ($is_exist) {
            Session::flash('message_error', 'Email sudah terdaftar');
            return response('Email sudah terdaftar', 409);
        }
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required',
            'kode_pos' => 'required',
        ]);
        // dd($request->input());
        $user = User::create([
            'name' => explode('@', $request->input('email'))[0],
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'), [
                'rounds' => 8,
            ]),
            'kode_otp' => mt_rand(1000, 9999),
            'resend_otp_at' => now(),
            'provinsi_id' => $request->input('provinsi'),
            'kabupaten_id' => $request->input('kabupaten'),
            'kecamatan_id' => $request->input('kecamatan'),
            'kelurahan_id' => $request->input('kelurahan'),
            'address' => $request->input('address'),
            'kode_pos' => $request->input('kode_pos'),
            // Set other additional data fields here
        ]);
        $user->assignRole($request->input('role'));

        return  response()->json(['user_id' => $user->id, 'otp' => $user->kode_otp, 'message' => 'Berhasil Register'], 201);
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
