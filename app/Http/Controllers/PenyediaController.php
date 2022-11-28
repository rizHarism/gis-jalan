<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use App\Models\Penyedia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class PenyediaController extends Controller
{
    //index
    public function index()
    {
        return view('penyedia.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Penyedia::get())
            ->addIndexColumn();

        return $datatables->make(true);;
    }

    public function getPenyedia()
    {
        $penyedia = Penyedia::get();
        $response = [
            'message' => 'get penyedia',
            'data' => $penyedia
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function show($id)
    {
        $penyedia = Penyedia::where('id', $id)->get();
        $response = [
            'message' => 'show penyedia',
            'data' => $penyedia
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:penyedia_jasa,nama',
            'direktur' => 'required|unique:penyedia_jasa,direktur',
            'alamat' => 'required|unique:penyedia_jasa,alamat',
            'nib' => 'required|unique:penyedia_jasa,nib',
            'npwp' => 'required|unique:penyedia_jasa,npwp',
        ]);

        $penyedia = Penyedia::create([
            'nama' => $request->nama,
            'direktur' => $request->direktur,
            'alamat' => $request->alamat,
            'nib' => $request->nib,
            'npwp' => $request->npwp,
        ]);

        if ($penyedia) {
            return response('Data Penyedia Jasa berhasil ditambahkan');
        } else {
            return response('Data Penyedia Jasa gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $penyedia = Penyedia::findOrFail($id);

        if ($penyedia->nama != $request->nama) {
            $validations['nama'] = 'required|unique:penyedia_jasa,nama';
        }
        if ($penyedia->direktur != $request->direktur) {
            $validations['direktur'] = 'required|unique:penyedia_jasa,direktur';
        }
        if ($penyedia->alamat != $request->alamat) {
            $validations['alamat'] = 'required|unique:penyedia_jasa,alamat';
        }
        if ($penyedia->nib != $request->nib) {
            $validations['nib'] = 'required|unique:penyedia_jasa,nib';
        }
        if ($penyedia->npwp != $request->npwp) {
            $validations['npwp'] = 'required|unique:penyedia_jasa,npwp';
        }
        $this->validate($request, $validations);

        $penyedia->nama = $request->nama;
        $penyedia->direktur = $request->direktur;
        $penyedia->alamat = $request->alamat;
        $penyedia->nib = $request->nib;
        $penyedia->npwp = $request->npwp;

        if ($penyedia->save()) {
            return response("Data Penyedia Jasa berhasil diubah!");
        } else {
            return response("Data Penyedia Jasa gagal diubah!", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $penyedia = Penyedia::findOrFail($id);
        $notExistPemeliharaan = Pemeliharaan::where('penyedia_jasa_id', $id)->doesntExist();
        if (($notExistPemeliharaan)) {
            if ($penyedia->delete()) {
                return response([
                    'value' => 1,
                    'message' => "Data \"" . $penyedia->nama . "\" berhasil dihapus"
                ]);
            } else {
                return response("Data gagal dihapus", Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response([
                'value' => 0,
                'message' => "Data \"" . $penyedia->nama . "\" tidak dapat dihapus, karena data sedang digunakan"
            ]);
        }
    }
}
