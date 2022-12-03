<section class="content">
    <div class="card">
        <div class="card-header">Data Master Kecamatan</div>
        <div class="card-body">
            <button class="btn btn-primary tambah-data"><i class="fa fa-plus"></i> Data Kecamatan</button>
            <hr>
            <table id="kecamatan" class="display stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kecamatan</th>
                        <th>Kode Kecamatan</th>
                        <th>Edit</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Kecamatan</th>
                        <th>Kode Kecamatan</th>
                        <th>Edit</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</section>


{{-- form modal --}}

<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="kecamatan-form" action="" method="">
                {{-- {{ csrf_field() }} --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama-kecamatan" class="col-sm-4 col-form-label">NAMA KECAMATAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama-kecamatan" id="nama-kecamatan"
                                value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode-kecamatan" class="col-sm-4 col-form-label">KODE KECAMATAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="kode-kecamatan" id="kode-kecamatan"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="simpan-kecamatan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
