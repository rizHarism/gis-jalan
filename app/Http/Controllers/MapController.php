<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Perkerasan;
use App\Models\RuasJalan;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class MapController extends Controller
{
    // function index
    public function index()
    {
        return view('map.index');
    }

    public function show($id)
    {
        $ruasjalan = RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
            ->where('id', $id)
            ->get();

        $response = [
            'data' => $ruasjalan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function getRuasId()
    {

        $ruasjalan = RuasJalan::select('id', 'nama_ruas as nama')->orderBy('id', 'asc')->get();
        $response = [
            'data' => $ruasjalan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function filterRuasId($id)
    {
        $_id = explode(',', $id);
        $ruasjalan = RuasJalan::select('id', 'nomor_ruas', 'nama_ruas', 'kelurahan_id', 'panjang', 'perkerasan_id', 'kondisi_id', 'geometry')
            ->with('kelurahan', 'kondisi', 'perkerasan')
            ->whereIn('id', $_id)
            ->get();
        $response = [
            'data' => $ruasjalan
        ];

        return response()->json($response, Response::HTTP_OK);;
    }

    public function getPolygon()
    {
        $ruasjalan = RuasJalan::select('id', 'nomor_ruas', 'nama_ruas', 'kelurahan_id', 'panjang', 'perkerasan_id', 'kondisi_id', 'geometry')
            ->with('kelurahan', 'kondisi', 'perkerasan')
            ->whereIn('kondisi_id', [1, 2, 3, 4])
            ->get();
        $response = [
            'data' => $ruasjalan
        ];

        return response()->json($response, Response::HTTP_OK);;
    }

    public function filterPolygon($kecamatan, $kelurahan, $kondisi)
    {
        $_kondisi = explode(",", $kondisi);
        if ($kecamatan == 0) {
            $ruasjalan = RuasJalan::select('id', 'nomor_ruas', 'nama_ruas', 'kelurahan_id', 'panjang', 'perkerasan_id', 'kondisi_id', 'geometry')
                ->with('kelurahan', 'kondisi', 'perkerasan')
                ->whereIn('kondisi_id', $_kondisi)
                ->get();
        } else if ($kecamatan !== 0 && $kelurahan == 0) {
            $ruasjalan = RuasJalan::select('id', 'nomor_ruas', 'nama_ruas', 'kelurahan_id', 'panjang', 'perkerasan_id', 'kondisi_id', 'geometry')
                ->with('kelurahan', 'kondisi', 'perkerasan')
                ->where('kecamatan_id', $kecamatan)
                ->whereIn('kondisi_id', $_kondisi)
                ->get();
        } else {
            $ruasjalan = RuasJalan::select('id', 'nomor_ruas', 'nama_ruas', 'kelurahan_id', 'panjang', 'perkerasan_id', 'kondisi_id', 'geometry')
                ->with('kelurahan', 'kondisi', 'perkerasan')
                ->where('kecamatan_id', $kecamatan)
                ->where('kelurahan_id', $kelurahan)
                ->whereIn('kondisi_id', $_kondisi)
                ->get();
        }

        $response = [
            'data' => $ruasjalan
        ];
        // return $ruasjalan;
        return response()->json($response, Response::HTTP_OK);;
    }

    public function pemeliharaan($id)
    {
        $pemeliharaan = Pemeliharaan::whereJsonContains('ruas_id', $id)
            ->with('penyedia:id,nama')
            ->orderBy('pelaksanaan', 'desc')
            ->get();
        $response = [
            'data' => $pemeliharaan
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
