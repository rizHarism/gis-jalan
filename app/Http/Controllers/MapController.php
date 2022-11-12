<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Perkerasan;
use App\Models\RuasJalan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MapController extends Controller
{
    // function index
    public function index()
    {
        return view('map.index');
    }

    public function getPolygon()
    {
        $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')->whereIn('kondisi_id', [1, 2, 3, 4]))
            ->addIndexColumn()
            ->make(true);

        // return $datatables->make(true);
        return $ruasjalan;
    }

    public function filterPolygon($kecamatan, $kelurahan, $kondisi)
    {
        $_kondisi = explode(",", $kondisi);
        if ($kecamatan == 0) {
            $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
                ->whereIn('kondisi_id', $_kondisi))
                ->addIndexColumn()
                ->make(true);
        } else if ($kecamatan !== 0 && $kelurahan == 0) {
            $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
                ->where('kecamatan_id', $kecamatan)
                ->whereIn('kondisi_id', $_kondisi))
                ->addIndexColumn()
                ->make(true);
        } else {
            $ruasjalan = DataTables::of(RuasJalan::with('kecamatan', 'kelurahan', 'kondisi', 'perkerasan')
                ->where('kecamatan_id', $kecamatan)
                ->where('kelurahan_id', $kelurahan)
                ->whereIn('kondisi_id', $_kondisi))
                ->addIndexColumn()
                ->make(true);
        }
        // return $datatables->make(true);
        return $ruasjalan;
    }
}
