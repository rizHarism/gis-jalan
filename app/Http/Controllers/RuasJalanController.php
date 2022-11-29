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
        $last_ruas = RuasJalan::latest()->take(1)->value('nomor_ruas');
        // dd($last_ruas);
        return view('kelurahan.form.index', [
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kondisi' => $kondisi,
            'perkerasan' => $perkerasan,
            'last_ruas' => $last_ruas + 1,
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'nomor' => 'required|unique:ruas_jalan,nomor_ruas',
            'nama' => 'required',
            'pangkal' => 'required',
            'ujung' => 'required',
            'lingkungan' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'bahuKanan' => 'required',
            'bahuKiri' => 'required',
            'kondisi' => 'required',
            'perkerasan' => 'required',
            'utilitas' => 'required',
            'geometry' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $ruas_jalan = RuasJalan::create([
                'nomor_ruas' => $request->nomor,
                'nama_ruas' => $request->nama,
                'pangkal_ruas' => $request->pangkal,
                'ujung_ruas' => $request->ujung,
                'lingkungan' => $request->lingkungan,
                'kelurahan_id' => $request->kelurahan,
                'kecamatan_id' => $request->kecamatan,
                'panjang' => $request->panjang,
                'lebar' => $request->lebar,
                'bahu_kanan' => $request->bahuKanan,
                'bahu_kiri' => $request->bahuKiri,
                'perkerasan_id' => $request->perkerasan,
                'kondisi_id' => $request->kondisi,
                'utilitas' => $request->utilitas,
                'start_x' => $request->startx,
                'start_y' => $request->starty,
                'mid_x' => $request->midx,
                'mid_y' => $request->midy,
                'end_x' => $request->endx,
                'end_y' => $request->endy,
                'geometry' => $request->geometry,
            ]);

            // if (!empty($request->polygon)) {

            //     $geometry = Geometry::create([
            //         'inventaris_id' => $inventaris->id,
            //         'polygon' => $request->polygon,
            //         'lat' => $request->lat,
            //         'lng' => $request->lng,
            //     ]);
            // }

            // if ($request->hasfile('image')) {
            //     $name = $request->file('image')->getClientOriginalName();
            //     $galery = Galery::create([
            //         'inventaris_id' => $inventaris->id,
            //         'image_path' => $name
            //     ]);
            //     $request->file('image')->move(public_path('assets/galery'), $name);
            // }

            // if ($request->hasfile('document')) {
            //     $name = $request->file('document')->getClientOriginalName();
            //     $document = Document::create([
            //         'inventaris_id' => $inventaris->id,
            //         'doc_path' => $name
            //     ]);
            //     $request->file('document')->move(public_path('assets/document'), $name);
            // }

            // dd($inventaris, $geometry, $galery, $document);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }

        return response("Data Ruas berhasil ditambahkan");
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

    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
        return response("Data Ruas berhasil dirubah");
    }
}
