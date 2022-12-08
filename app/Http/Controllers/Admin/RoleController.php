<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $response = [
            'permissionsFormatted' => $permissionsFormatted
        ];
        return Response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {

        $_permission = explode(",", $request->permission);
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::create(['name' => $request->input('role_name')]);
            $role->syncPermissions($_permission);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 501);
        }

        return response('Hak akses ' . $role->name . ' berhasil dibuat');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

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

        $response = [
            'role' => $role,
            'permissionsFormatted' => $permissionsFormatted,
            'rolePermissions' => $rolePermissions,
        ];
        return Response()->json($response, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $_permission = explode(",", $request->permission);
        $this->validate($request, [
            'role_name' => 'required',
            'permission' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::find($id);
            $role->name = $request->role_name;
            $role->save();
            $role->syncPermissions($_permission);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response('Failed to update the role.', 500);
        }

        return response('Role ' . $role->name . ' berhasil di update');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            DB::beginTransaction();

            $role->syncPermissions([]);
            $role->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 501);
        }

        return response("Role berhasil dihapus");
    }
}
