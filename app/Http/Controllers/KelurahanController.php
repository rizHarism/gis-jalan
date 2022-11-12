<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KelurahanController extends Controller
{
    //
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
}
