<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    //
    public function index()
    {
        return view('master.kecamatan.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Kecamatan::get())->addIndexColumn();
        return $datatables->make(true);
    }


    public function getKecamatan()
    {
        $kecamatan = Kecamatan::orderBy('nama', 'ASC')->get()->all();
        $response = [
            'message' => 'data kecamatan',
            'count' => count($kecamatan),
            'data' => $kecamatan
        ];
        // dd($response);
        return response()->json($response, Response::HTTP_OK);
    }


    public function show($id)
    {
        $kecamatan = $kecamatan = Kecamatan::where('id', $id)->get();
        $response = [
            'message' => 'show kecamatan',
            'data' => $kecamatan
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
