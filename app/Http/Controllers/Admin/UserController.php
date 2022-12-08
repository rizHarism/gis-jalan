<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.index');
    }

    public function datatables()
    {
        $datatables = DataTables::of(User::with('roles')
            ->orderBy('id', 'asc'))
            ->addIndexColumn();
        return $datatables->make(true);
    }

    public function getRole()
    {
        $role = Role::orderBy('id', 'ASC')->get()->all();
        $response = [
            'message' => 'data role',
            'data' => $role
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $response = [
            'message' => 'data user',
            'data' => $user
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'password' => 'required',
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/image/avatar'), $image);
        } else {
            $image = 'avatar-default.png';
        }
        // dd($image);
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->nama_lengkap,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'avatar' => $image,
            ]);

            $role = Role::findById($request->role);
            // dd($role);
            $user->assignRole($role);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }

        return response("User Berhasil Ditambahkan");
    }

    public function update(Request $request, $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $oldRole = $user->roles->first();
        $validations = [];
        // dd($user);
        if ($user->name != $request->nama_lengkap) {
            $validations['nama_lengkap'] = 'required';
        }
        if ($user->username != $request->username) {
            $validations['username'] = 'required|unique:users,username';
        }
        $this->validate($request, $validations);

        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/image/avatar'), $image);
        } else {
            $image = 'avatar-default.png';
        }
        // dd($image);
        try {
            DB::beginTransaction();

            $user->name = $request->nama_lengkap;
            $user->username = $request->username;
            $user->avatar = $image;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $role = Role::findById($request->role);
            $user->removeRole($oldRole);
            $user->assignRole($role);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }

        return response("Update User Berhasil");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return response("User Berhasil Dihapus");
    }
}
