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
use Illuminate\Support\Facades\DB;

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
        $last_ruas = RuasJalan::orderBy('nomor_ruas', 'desc')->latest()->value('nomor_ruas');
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
        // dd($request->all());
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

        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/image/ruas-jalan'), $image);
        } else {
            $image = 'default.jpg';
        }
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
                'middle_x' => $request->midx,
                'middle_y' => $request->midy,
                'end_x' => $request->endx,
                'end_y' => $request->endy,
                'geometry' => $request->geometry,
                'image' => $image,
            ]);

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
        // dd($request->all(), $id);
        $ruas = RuasJalan::findOrFail($id);
        $validations = [];

        if ($ruas->nomor_ruas != $request->nomor) {
            $validations['nomor'] = 'required';
        }
        if ($ruas->nama_ruas != $request->nama) {
            $validations['nama'] = 'required';
        }
        if ($ruas->pangkal_ruas != $request->pangkal) {
            $validations['pangkal'] = 'required';
        }
        if ($ruas->ujung_ruas != $request->ujung) {
            $validations['ujung'] = 'required';
        }
        if ($ruas->lingkungan != $request->lingkungan) {
            $validations['lingkungan'] = 'required';
        }
        if ($ruas->kelurahan_id != $request->kelurahan) {
            $validations['kelurahan'] = 'required';
        }
        if ($ruas->kecamatan_id != $request->kecamatan) {
            $validations['kecamatan'] = 'required';
        }
        if ($ruas->panjang != $request->panjang) {
            $validations['panjang'] = 'required';
        }
        if ($ruas->lebar != $request->lebar) {
            $validations['lebar'] = 'required';
        }
        if ($ruas->bahu_kanan != $request->bahuKanan) {
            $validations['bahuKanan'] = 'required';
        }
        if ($ruas->bahu_kiri != $request->bahuKiri) {
            $validations['bahuKiri'] = 'required';
        }
        if ($ruas->perkerasan_id != $request->perkerasan) {
            $validations['perkerasan'] = 'required';
        }
        if ($ruas->kondisi_id != $request->kondisi) {
            $validations['kondisi'] = 'required';
        }
        if ($ruas->geometry != $request->geometry) {
            $validations['geometry'] = 'required';
        }

        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/image/ruas-jalan'), $image);
        } else {
            $image = $ruas->image;
        }

        try {
            DB::beginTransaction();

            $ruas->nomor_ruas = $request->nomor;
            $ruas->nama_ruas = $request->nama;
            $ruas->pangkal_ruas = $request->pangkal;
            $ruas->ujung_ruas = $request->ujung;
            $ruas->lingkungan = $request->lingkungan;
            $ruas->kelurahan_id = $request->kelurahan;
            $ruas->kecamatan_id = $request->kecamatan;
            $ruas->panjang = $request->panjang;
            $ruas->lebar = $request->lebar;
            $ruas->bahu_kanan = $request->bahuKanan;
            $ruas->bahu_kiri = $request->bahuKiri;
            $ruas->perkerasan_id = $request->perkerasan;
            $ruas->kondisi_id = $request->kondisi;
            $ruas->utilitas = $request->utilitas;
            $ruas->start_x = $request->startx;
            $ruas->start_y = $request->starty;
            $ruas->middle_x = $request->midx;
            $ruas->middle_y = $request->midy;
            $ruas->end_x = $request->endx;
            $ruas->end_y = $request->endy;
            $ruas->geometry = $request->geometry;
            $ruas->image = $image;


            $ruas->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
        return response("Data Ruas berhasil dirubah");
    }
    public function destroy($id)
    {
        $ruas = RuasJalan::findOrFail($id);

        if ($ruas->delete()) {
            return response([
                'value' => 1,
                'message' => "Data Ruas Jalan berhasil dihapus"
            ]);
        } else {
            return response("Data Ruas Jalan gagal dihapus", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
