<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        $dataPerusahaan = Tentang::all();

        return view('tentang', ['dataPerusahaans' => $dataPerusahaan]);
    }
}
