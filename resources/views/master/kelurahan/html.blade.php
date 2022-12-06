<section class="content">
    <div class="card">
        <div class="card-header">Data Master Kelurahan</div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <button class="btn btn-primary btn-sm tambah-data"><i class="fa fa-plus"></i> Data Kelurahan</button>
                </div>
                <div class="col-4">
                    <form method="" class="" action="" id="filter-datatables">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-1">
                                <i class="fas fa-search "></i>
                            </div>
                            <div class="col-9">
                                <select class="select-kecamatan " name="kecamatan" id="list-kecamatan">
                                    <option value="0"> SEMUA KECAMATAN </option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary btn-sm ml-3">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                            <input type="text" class="form-control" id="nama-kelurahan" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama-kecamatan" class="col-sm-4 col-form-label">NAMA KECAMATAN</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="nama-kecamatan" required>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode-kelurahan" class="col-sm-4 col-form-label">KODE KELURAHAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode-kelurahan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" id="simpan-kelurahan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
