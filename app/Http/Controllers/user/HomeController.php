<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\HargaModel;
use App\Models\PedagangModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.home');
    }

    public function tentang_pasar()
    {
        return view('user.tentang');
    }

    public function pedagang(Request $request)
    {
        $request->data['pedagang'] = PedagangModel::get();
        return view('user.pedagang', $request->data);
    }

    public function harga(Request $request)
    {
        $request->data['harga'] = HargaModel::get();
        return view('user.harga', $request->data);
    }

    public function about()
    {
        return view('user.about');
    }

    public function kontak()
    {
        return view('user.kontak');
    }
}
