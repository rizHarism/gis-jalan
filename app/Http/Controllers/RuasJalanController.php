<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KondisiJalan;
use App\Models\Perkerasan;
use App\Models\RuasJalan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RuasJalanController extends Controller
{
    //
    public function index()
    {
        return view('kelurahan.index');
    }

    public function datatables()
    {
        $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan'))
            ->addIndexColumn()
            ->make(true);

        return $ruasjalan;
    }

    public function filterRuas($kecamatan, $kelurahan, $kondisi, $perkerasan)
    {
        $_kondisi = array();
        $_perkerasan = array();
        ($kondisi == 0) ? array_push($_kondisi, '1', '2', '3', '4') : array_push($_kondisi, $kondisi);
        ($perkerasan == 0) ? array_push($_perkerasan, '1', '2', '3', '4', '5') : array_push($_perkerasan, $perkerasan);
        if ($kecamatan == 0 && $kelurahan == 0) {
            $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
                // ->where('kecamatan_id', $kecamatan)
                ->whereIn('kondisi_id', $_kondisi)
                ->whereIn('perkerasan_id', $_perkerasan))
                ->addIndexColumn()
                ->make(true);
        } else if ($kecamatan !== 0 && $kelurahan == 0) {
            $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
                ->where('kecamatan_id', $kecamatan)
                // ->where('kelurahan_id', $kelurahan)
                ->whereIn('kondisi_id', $_kondisi)
                ->whereIn('perkerasan_id', $_perkerasan))
                ->addIndexColumn()
                ->make(true);
        } else {
            $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
                ->where('kecamatan_id', $kecamatan)
                ->where('kelurahan_id', $kelurahan)
                ->whereIn('kondisi_id', $_kondisi)
                ->whereIn('perkerasan_id', $_perkerasan))
                ->addIndexColumn()
                ->make(true);
        }

        return $ruasjalan;
    }

    public function show($id)
    {
        $ruas = RuasJalan::where('id', $id)->GET();

        $response = [
            'message' => 'show ruas jalan',
            'data' => $ruas
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function create()
    {
        $kecamatan = Kecamatan::orderBy('nama', 'asc')->get();
        $kelurahan = Kelurahan::orderBy('nama', 'asc')->get();
        $kondisi = KondisiJalan::orderBy('id', 'asc')->get();
        $perkerasan = Perkerasan::orderBy('id', 'asc')->get();
        return view('kelurahan.form.index', [
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kondisi' => $kondisi,
            'perkerasan' => $perkerasan,
        ]);
    }

    public function edit($id)
    {
        $ruasjalan = RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')->findOrFail($id);
        $kecamatan = Kecamatan::orderBy('nama', 'asc')->get();
        $kelurahan = Kelurahan::orderBy('nama', 'asc')->get();
        $kondisi = KondisiJalan::orderBy('id', 'asc')->get();
        $perkerasan = Perkerasan::orderBy('id', 'asc')->get();
        return view('kelurahan.form.index', [
            'edit' => $ruasjalan,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kondisi' => $kondisi,
            'perkerasan' => $perkerasan,
        ]);
    }
}
