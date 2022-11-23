<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PemeliharaanController extends Controller
{
    //
    public function index()
    {
        return view('pemeliharaan.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Pemeliharaan::get())
            ->addIndexColumn();

        return $datatables->make(true);;
    }

    public function tesJson()
    {
        $datatables = DataTables::of(Pemeliharaan::whereJsonContains('ruas_id', '1')
            ->with('penyedia:id,nama')
            ->get())
            ->addIndexColumn();

        return $datatables->make(true);;
    }
}
