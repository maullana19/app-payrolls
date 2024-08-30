<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $q = $request->input('q');
        return view('search', ['q' => $q]);
    }

    public function searchResults(Request $request)
    {
        try {
            $q = $request->input('q');
            $karyawans = Karyawan::where('nama_lengkap', 'like', '%' . $q . '%')
                ->orWhere('nik', 'like', '%' . $q . '%')
                ->orWhere('email', 'like', '%' . $q . '%')
                ->get();
            return view('search_page', ['q' => $q, 'karyawans' => $karyawans]);
        } catch (\Throwable $th) {
            return view('search-results', ['q' => $q]);
        }
    }
}
