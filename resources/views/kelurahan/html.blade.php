<section class="content">
    <div class="card">
        <div class="card-header">Data Ruas Jalan Kelurahan</div>
        <div class="card-body">
            <div>
                <form method="" action="" id="filter-datatables">
                    {{ csrf_field() }}
                    <div class="mb-3 mt-0">
                        <i class="fas fa-search mr-2"></i>
                        <select class="js-example-basic-single " name="kecamatan" id="list-kecamatan">
                            <option value="0"> SEMUA KECAMATAN </option>
                        </select>

                        <select class="js-example-basic-single " name="kelurahan" id="list-kelurahan" disabled hidden>
                            <option value="0"> SEMUA KELURAHAN </option>
                        </select>

                        <button class="btn btn-primary btn-sm ml-3">Cari</button>
                </form>
            </div>
            <hr>
            <div class="mt-3">
                <table id="ruas-jalan" class="display stripped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Ruas</th>
                            <th>Nama Ruas</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Panjang</th>
                            <th>Perkerasan</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>No. Ruas</th>
                            <th>Nama Ruas</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Panjang</th>
                            <th>Perkerasan</th>
                            <th>Kondisi</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</section>
