<section class="content">
    <div class="card">
        <div class="card-header">Data Riwayat Pemeliharaan</div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <button class="btn btn-primary btn-sm tambah-data"><i class="fa fa-plus"></i> Data
                        Pemeliharaan</button>
                </div>
                <div class="col-4">
                    <form method="" class="" action="" id="filter-datatables">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-1">
                                <i class="fas fa-search "></i>
                            </div>
                            <div class="col-9">
                                <select class="select-penyedia" name="penyedia" id="list-penyedia">
                                    <option value="0"> SEMUA PENYEDIA JASA </option>
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
            <table id="pemeliharaan" class="display stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Penyedia Jasa</th>
                        <th>Biaya</th>
                        <th>Ruas</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Penyedia Jasa</th>
                        <th>Biaya</th>
                        <th>Ruas</th>
                        <th>Keterangan</th>
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
            <form id="pemeliharaan-form">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="pelaksanaan" class="col-sm-4 col-form-label">TGL. PELAKSANAAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pelaksanaan" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyedia" class="col-sm-4 col-form-label">PENYEDIA JASA</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="penyedia">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggaran" class="col-sm-4 col-form-label">ANGGARAN</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="anggaran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no-ruas" class="col-sm-4 col-form-label multiple">RUAS</label>
                        <div class="col-sm-8">
                            <select class="select-no-ruas" multiple="multiple" id="no-ruas">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-4 col-form-label">KETERANGAN</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="simpan-pemeliharaan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
