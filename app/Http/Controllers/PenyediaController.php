<?php

namespace App\Http\Controllers;

use App\Models\Penyedia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
}
