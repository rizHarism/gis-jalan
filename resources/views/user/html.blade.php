<section class="content">
    <div class="card">
        <div class="card-header">Data Pengguna</div>
        <div class="card-body">
            <button class="btn btn-primary tambah-data"><i class="fa fa-plus"></i> Data Pengguna</button>
            <hr>
            <table id="user-table" class="display stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Login Terakhir</th>
                        <th>Alamat Ip</th>
                        <th>Aksi</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Login Terakhir</th>
                        <th>Alamat Ip</th>
                        <th>Aksi</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


</section>

<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="user-form" action="" method=""
                oninput="password2.setCustomValidity(password2.value != password.value ? 'Passwords do not match.' : '')">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mx-auto d-block">
                        {{-- <label for="foto-user" class="col-sm-4 col-form-label">FOTO PENGGUNA</label> --}}
                        <label for="image-user" class="mx-auto d-block">
                            <a title="Foto Ruas">
                                <img id="foto-user" src="{{ asset('assets/image/avatar/avatar-default.png') }}"
                                    alt="Ruas" class="rounded-circle img-thumbnail mx-auto d-block"
                                    style="cursor:pointer; height: 150px; width: 150px">
                            </a>
                        </label>
                        <p class="text-center" style="font-style: italic; font-size: 12px">
                            *klik untuk merubah foto</p>
                        <input id="image-user" type="file" style="display: none;"
                            accept="image/png, image/jpg, image/jpeg" />
                    </div>
                    <div class="form-group row">
                        <label for="nama-asli" class="col-sm-4 col-form-label">NAMA LENGKAP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama-asli" id="nama-asli" value=""
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama-user" class="col-sm-4 col-form-label">NAMA PENGGUNA</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama-user" id="nama-user" value=""
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role-user" class="col-sm-4 col-form-label">ROLE PENGGUNA</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="role-select" id="role-user">

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label" id="password">KATA SANDI</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" id="password-1" value=""
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-2" class="col-sm-4 col-form-label">VERIFIKASI KATA SANDI</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password2" id="password-2" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" id="simpan-user">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
