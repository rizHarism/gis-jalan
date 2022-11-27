<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\RuasJalan;
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
        $datatables = DataTables::of(Kelurahan::with('kecamatan')->orderby('kecamatan_id', 'asc')
            ->get())
            ->addIndexColumn();
        return $datatables->make(true);
    }

    public function filterkelurahan($id)
    {
        $datatables = DataTables::of(Kelurahan::with('kecamatan')
            ->where('kecamatan_id', $id)
            ->orderby('kecamatan_id', 'asc')
            ->get())
            ->addIndexColumn();
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:kelurahan,nama',
            'kecamatan_id' => 'required',
            'kode' => 'required',
        ]);

        $kelurahan = Kelurahan::create([
            'nama' => $request->nama,
            'kecamatan_id' => $request->kecamatan_id,
            'kode_kelurahan' => $request->kode
        ]);

        if ($kelurahan) {
            return response('Data Kelurahan berhasil ditambahkan');
        } else {
            return response('Data Kelurahan gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);

        if ($kelurahan->nama != $request->nama) {
            $validations['nama'] = 'required|unique:kelurahan,nama';
        }
        if ($kelurahan->kode_kelurahan != $request->kode) {
            $validations['kode'] = 'required';
        }
        $this->validate($request, $validations);

        $kelurahan->nama = $request->nama;
        $kelurahan->kecamatan_id = $request->kecamatan_id;
        $kelurahan->kode_kelurahan = $request->kode;

        if ($kelurahan->save()) {
            return response("Data Kecamatan berhasil diubah!");
        } else {
            return response("Data Kecamatan gagal diubah!", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $notExistRuas = RuasJalan::where('kelurahan_id', $id)->doesntExist();
        // $notExistKelurahan = Kelurahan::where('kecamatan_id', $id)->doesntExist();
        if ($notExistRuas) {
            if ($kelurahan->delete()) {
                return response([
                    'value' => 1,
                    'message' => "Data \"" . $kelurahan->nama . "\" berhasil dihapus"
                ]);
            } else {
                return response("Data gagal dihapus", Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response([
                'value' => 0,
                'message' => "Data \"" . $kelurahan->nama . "\" tidak dapat dihapus, karena data sedang digunakan"
            ]);
        }
    }
}
