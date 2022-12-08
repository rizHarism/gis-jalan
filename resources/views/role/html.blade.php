<section class="content">
    <div class="card">
        <div class="card-header">Data Pengguna</div>
        <div class="card-body">
            <button class="btn btn-primary tambah-data"><i class="fa fa-plus"></i> Data Hak Akses</button>
            <hr>
            <table id="role-table" class="display stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Aksi</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


</section>

<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="role-form" method="POST" class="form-horizontal" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="role-name" class="col-sm-2 col-form-label">Hak Akses</label>
                        <div class="col-sm-10">
                            <input type="text" name="role-name" class="form-control" id="role-name"
                                placeholder="Nama Hak Akses" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="permissions" class="col-sm-2 col-form-label">Permissions</label>
                        <div class="col-sm-10">
                            <div class="row" id="row-role">
                                {{-- @foreach ($permissionsFormatted as $key => $permissionNames)
                                <div class="col-sm-4" style="margin-bottom: 20px;">
                                    <span>{{ strtoupper($key) }}</span><br />
                                    @foreach ($permissionNames as $i => $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input name="permission[]" class="custom-control-input" type="checkbox"
                                                id="{{ $key . '-' . $permission['name'] . '-' . $i }}"
                                                value="{{ $permission['value'] }}"
                                                {{ $editable && in_array($permission['value'], $rolePermissions) ? 'checked="checked"' : '' }}>
                                            <label for="{{ $key . '-' . $permission['name'] . '-' . $i }}"
                                                class="custom-control-label">{{ $permission['name'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary float-right" id="role-simpan">Simpan</button>
                    {{-- <a href="{{ route('roles.index') }}" class="btn btn-default float-right">Batal</a> --}}
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
