<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\RuasJalan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    //
    public function index()
    {
        return view('master.kecamatan.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Kecamatan::get())->addIndexColumn();
        return $datatables->make(true);
    }


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


    public function show($id)
    {
        $kecamatan = Kecamatan::where('id', $id)->get();
        $response = [
            'message' => 'show kecamatan',
            'data' => $kecamatan
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:kecamatan,nama',
            'kode' => 'required|unique:kecamatan,kode_kecamatan'
        ]);

        $kecamatan = Kecamatan::create([
            'nama' => $request->nama,
            'kode_kecamatan' => $request->kode,
        ]);

        if ($kecamatan) {
            return response("Data Kecamatan sudah berhasil ditambahkan!");
        } else {
            return response("Data gagal ditambahkan!");
        };
    }

    public function update(Request $request, $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);

        if ($kecamatan->nama != $request->nama) {
            $validations['nama'] = 'required|unique:kecamatan,nama';
        }
        if ($kecamatan->kode_kecamatan != $request->kode) {
            $validations['kode'] = 'required|unique:kecamatan,kode_kecamatan';
        }
        $this->validate($request, $validations);

        $kecamatan->nama = $request->nama;
        $kecamatan->kode_kecamatan = $request->kode;

        if ($kecamatan->save()) {
            return response("Data Kecamatan berhasil diubah!");
        } else {
            return response("Data Kecamatan gagal diubah!", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $notExistRuas = RuasJalan::where('kecamatan_id', $id)->doesntExist();
        $notExistKelurahan = Kelurahan::where('kecamatan_id', $id)->doesntExist();
        if (($notExistRuas) && ($notExistKelurahan)) {
            if ($kecamatan->delete()) {
                return response([
                    'value' => 1,
                    'message' => "Data \"" . $kecamatan->nama . "\" berhasil dihapus"
                ]);
            } else {
                return response("Data gagal dihapus", Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response([
                'value' => 0,
                'message' => "Data \"" . $kecamatan->nama . "\" tidak dapat dihapus, karena data sedang digunakan"
            ]);
        }
    }
}
