<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;


class RoleController extends Controller
{
    //
    public function index()
    {
        return view('role.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(Role::query())
            ->addIndexColumn();
        return $datatables->make(true);
    }

    public function create()
    {
        $permissions = Permission::get();

        $permissionsFormatted = [];

        if ($permissions) {
            foreach ($permissions as $permission) {
                $_permission = explode(".", $permission->name);
                if (count($_permission) == 2) {
                    $permissionsFormatted[$_permission[0]][] = [
                        'name' => $_permission[1],
                        'value' => $permission->id
                    ];
                }
            }
        }
        // return view('roles.form', [
        //     'permissions' => $permissions,
        //     'permissionsFormatted' => $permissionsFormatted
        // ]);
        $response = [
            'permissions' => $permissions,
            'permissionsFormatted' => $permissionsFormatted
        ];
        return Response()->json($response, Response::HTTP_OK);
    }
}
