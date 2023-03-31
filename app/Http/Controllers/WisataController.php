<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\DataTables;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Wisata::select('id','nama','alamat', 'deskripsi', 'harga_tiket')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-icon btn-sm"> <i class="bx bx-edit"></i></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-icon btn-sm"><i class="bx bx-trash"></i></button>';
                    return $button;
                })
                ->make(true);
        }
 
        return view('pages.wisata');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama'          =>  'required',
            'alamat'        =>  'required',
            'deskripsi'     =>  'required',
            'harga_tiket'   =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
 
        $form_data = array(
            'nama'        =>  $request->nama,
            'alamat'      =>  $request->alamat,
            'deskripsi'   =>  $request->deskripsi,
            'harga_tiket' =>  $request->harga_tiket,
        );
 
        Wisata::create($form_data);
 
        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(request()->ajax())
        {
            $data = Wisata::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rules = array(
            'nama'        =>  'required',
            'alamat'      =>  'required',
            'deskripsi'   =>  'required',
            'harga_tiket' =>  'required'
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
 
        $form_data = array(
            'nama'       =>  $request->nama,
            'alamat'     =>  $request->alamat,
            'deskripsi'  =>  $request->deskripsi,
            'harga_tiket'=>  $request->harga_tiket,
        );
 
        Wisata::whereId($request->hidden_id)->update($form_data);
 
        return response()->json(['success' => 'Data berhasil diubah']);
    }

    public function destroy(string $id)
    {
        $data = Wisata::find($id);
        $data->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
