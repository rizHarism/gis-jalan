<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\KondisiJalan;
use App\Models\RuasJalan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    //function index
    public function index()
    {
        return view('dashboard.index');
    }

    // function get all data with datatable

    public function getChart()
    {
        $baik = count(RuasJalan::where('kondisi_id', 1)->get());
        $sedang = count(RuasJalan::where('kondisi_id', 2)->get());
        $rusak_r = count(RuasJalan::where('kondisi_id', 3)->get());
        $rusak_b = count(RuasJalan::where('kondisi_id', 4)->get());
        $kondisi = KondisiJalan::get()->pluck('kondisi');

        $response = [
            'baik' => $baik,
            'sedang' => $sedang,
            'rusak_r' => $rusak_r,
            'rusak_b' => $rusak_b,
            'kondisi' => $kondisi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function getFilterChart($kec, $kel)
    {
        if ($kel == 0) {
            $baik = count(RuasJalan::where('kondisi_id', 1)->where('kecamatan_id', $kec)->get());
            $sedang = count(RuasJalan::where('kondisi_id', 2)->where('kecamatan_id', $kec)->get());
            $rusak_r = count(RuasJalan::where('kondisi_id', 3)->where('kecamatan_id', $kec)->get());
            $rusak_b = count(RuasJalan::where('kondisi_id', 4)->where('kecamatan_id', $kec)->get());
        } else {
            $baik = count(RuasJalan::where('kondisi_id', 1)->where('kecamatan_id', $kec)->where('kelurahan_id', $kel)->get());
            $sedang = count(RuasJalan::where('kondisi_id', 2)->where('kecamatan_id', $kec)->where('kelurahan_id', $kel)->get());
            $rusak_r = count(RuasJalan::where('kondisi_id', 3)->where('kecamatan_id', $kec)->where('kelurahan_id', $kel)->get());
            $rusak_b = count(RuasJalan::where('kondisi_id', 4)->where('kecamatan_id', $kec)->where('kelurahan_id', $kel)->get());
        }
        $kondisi = KondisiJalan::get()->pluck('kondisi');
        $response = [
            'baik' => $baik,
            'sedang' => $sedang,
            'rusak_r' => $rusak_r,
            'rusak_b' => $rusak_b,
            'kondisi' => $kondisi
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
