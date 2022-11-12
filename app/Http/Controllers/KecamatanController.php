<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KecamatanController extends Controller
{
    //
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
}
