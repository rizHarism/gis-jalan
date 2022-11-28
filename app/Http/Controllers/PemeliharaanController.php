<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PemeliharaanController extends Controller
{
    //
    public function index()
    {
        return view('pemeliharaan.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Pemeliharaan::with('penyedia')->get())
            ->addIndexColumn();

        return $datatables->make(true);;
    }

    public function filterPemeliharaan($id)
    {
        $datatables = DataTables::of(Pemeliharaan::with('penyedia')->where('penyedia_jasa_id', $id)->get())
            ->addIndexColumn();

        return $datatables->make(true);;
    }

    public function show($id)
    {
        $pemeliharaan = Pemeliharaan::with('penyedia')->where('id', $id)->get();
        $response = [
            'message' => 'show pemeliharaan',
            'data' => $pemeliharaan
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'pelaksanaan' => 'required',
            'penyedia' => 'required',
            'anggaran' => 'required',
            'ruas' => 'required',
            'keterangan' => 'required',
        ]);

        $formatDate = Carbon::createFromFormat('d/m/Y', $request->pelaksanaan)->format('Y-m-d');

        $pemeliharaan = Pemeliharaan::create([
            'pelaksanaan' => $formatDate,
            'penyedia_jasa_id' => $request->penyedia,
            'biaya' => $request->anggaran,
            'ruas_id' => $request->ruas,
            'keterangan' => $request->keterangan,
        ]);

        if ($pemeliharaan) {
            return response('Data Pemeliharaan berhasil ditambahkan');
        } else {
            return response('Data Pemeliharaan gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $formatDate = Carbon::createFromFormat('d/m/Y', $request->pelaksanaan)->format('Y-m-d');
        $pemeliharaan = Pemeliharaan::findOrFail($id);

        if ($pemeliharaan->pelaksanaan != $formatDate) {
            $validations['pelaksanaan'] = 'required';
        }
        if ($pemeliharaan->penyedia_jasa_id != $request->penyedia) {
            $validations['penyedia'] = 'required';
        }
        if ($pemeliharaan->biaya != $request->anggaran) {
            $validations['anggaran'] = 'required';
        }
        if ($pemeliharaan->ruas_id != $request->ruas) {
            $validations['anggaran'] = 'required';
        }
        if ($pemeliharaan->keterangan != $request->keterangan) {
            $validations['keterangan'] = 'required';
        }
        $this->validate($request, $validations);

        $pemeliharaan->pelaksanaan = $formatDate;
        $pemeliharaan->penyedia_jasa_id = $request->penyedia;
        $pemeliharaan->biaya = $request->anggaran;
        $pemeliharaan->ruas_id = $request->ruas;
        $pemeliharaan->keterangan = $request->keterangan;

        if ($pemeliharaan->save()) {
            return response("Data Pemeliharaan berhasil diubah!");
        } else {
            return response("Data Pemeliharaan gagal diubah!", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function tesJson()
    {
        $datatables = DataTables::of(Pemeliharaan::whereJsonContains('ruas_id', '1')
            ->with('penyedia:id,nama')
            ->get())
            ->addIndexColumn();

        return $datatables->make(true);;
    }

    public function destroy($id)
    {
        $pemeliharaan = Pemeliharaan::findOrFail($id);
        // $notExistRuas = RuasJalan::where('kelurahan_id', $id)->doesntExist();
        // $notExistKelurahan = Kelurahan::where('kecamatan_id', $id)->doesntExist();
        // if ($notExistRuas) {
        if ($pemeliharaan->delete()) {
            return response([
                'value' => 1,
                'message' => "Data Pemeliharaan berhasil dihapus"
            ]);
        } else {
            return response("Data gagal dihapus", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        // } else {
        //     return response([
        //         'value' => 0,
        //         'message' => "Data \"" . $kelurahan->nama . "\" tidak dapat dihapus, karena data sedang digunakan"
        //     ]);
        // }
    }
}
