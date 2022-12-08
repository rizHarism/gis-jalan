<section class="content">
    <div class="card">
        <div class="card-header">Data Penyedia Jasa</div>
        <div class="card-body">
            <div class="col-8">
                <button class="btn btn-primary btn-sm tambah-data"><i class="fa fa-plus"></i> Data Penyedia Jasa</button>
            </div>
            <hr>
            <table id="penyedia-jasa" class="display stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Penyedia</th>
                        <th>Alamat</th>
                        <th>Direktur</th>
                        <th>No. NIB</th>
                        <th>No. NPWP</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Penyedia</th>
                        <th>Alamat</th>
                        <th>Direktur</th>
                        <th>No. NIB</th>
                        <th>No. NPWP</th>
                        <th></th>
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
            <form id="penyedia-form">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama-penyedia" class="col-sm-4 col-form-label">NAMA BADAN USAHA</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama-penyedia" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama-direktur" class="col-sm-4 col-form-label">NAMA DIREKTUR</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama-direktur" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-4 col-form-label">ALAMAT</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nib" class="col-sm-4 col-form-label">NIB</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nib" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="npwp" class="col-sm-4 col-form-label">NPWP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="npwp" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" id="simpan-penyedia">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
