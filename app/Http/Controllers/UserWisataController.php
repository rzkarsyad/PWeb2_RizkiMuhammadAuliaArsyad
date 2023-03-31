<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserWisataController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Wisata::select('id','nama','alamat', 'deskripsi', 'harga_tiket')->get();
            return DataTables::of($data)->addIndexColumn()
                ->make(true);
        }
 
        return view('pages.u_wisata');
    }
}
