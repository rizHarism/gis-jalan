<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KelurahanController extends Controller
{
    //

    public function index()
    {
        return view('master.kelurahan.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Kelurahan::with('kecamatan')->get())->addIndexColumn();
        // $datatables = DataTables::of(Kelurahan::get())->addIndexColumn();
        return $datatables->make(true);
    }

    public function getKelurahan($id)
    {
        $kelurahan = Kelurahan::where('kecamatan_id', $id)->orderBy('nama', 'ASC')->get()->all();
        $response = [
            'message' => 'data kelurahan',
            'count' => count($kelurahan),
            'data' => $kelurahan
        ];
        // dd($response);
        return response()->json($response, Response::HTTP_OK);
    }


    public function show($id)
    {
        $kelurahan = Kelurahan::with('kecamatan')->where('id', $id)->get();
        $response = [
            'message' => 'show kelurahan',
            'data' => $kelurahan
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
