<section class="content">
    <div class="card">
        <div class="card-header">Data Master Kelurahan</div>
        <div class="card-body">
            <button class="btn btn-primary tambah-data"><i class="fa fa-plus"></i> Data Kelurahan</button>
            <hr>
            <table id="kelurahan" class="display stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelurahan</th>
                        <th>Nama Kecamatan</th>
                        <th>Kode Kecamatan</th>
                        <th>kode Kelurahan</th>
                        <th>Edit</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelurahan</th>
                        <th>Nama Kecamatan</th>
                        <th>Kode Kecamatan</th>
                        <th>kode Kelurahan</th>
                        <th>Edit</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


</section>

{{-- edit modal --}}

<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="kelurahan-form">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama-kelurahan" class="col-sm-4 col-form-label">NAMA KELURAHAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama-kelurahan" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama-kecamatan" class="col-sm-4 col-form-label">NAMA KECAMATAN</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="nama-kecamatan">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode-kelurahan" class="col-sm-4 col-form-label">KODE KELURAHAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode-kelurahan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="simpan-kelurahan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
