<section class="content">
    <div class="card">
        <div class="card-header">Data Ruas Jalan Kelurahan</div>
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-5">
                        <a href="/ruas/kelurahan/create" class="btn btn-primary btn-sm tambah-data"><i
                                class="fa fa-plus"></i> Data Ruas</a>
                    </div>
                    <div class="col-7">
                        <form method="" action="" id="filter-datatables">
                            {{ csrf_field() }}
                            <div class="row bolder">
                                <div class="col-1">
                                    <i class="fas fa-search ml-5"></i>
                                </div>
                                <div class="col-3">
                                    <select class="select-kecamatan" name="kecamatan" id="list-kecamatan">
                                        <option value="0"> SEMUA KECAMATAN </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="select-kelurahan" name="kelurahan" id="list-kelurahan" disabled>
                                        <option value="0"> SEMUA KELURAHAN </option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="select-kondisi" name="kondisi" id="list-kondisi">
                                        <option value="0"> SEMUA KONDISI </option>
                                        <option value="1"> BAIK </option>
                                        <option value="2"> SEDANG </option>
                                        <option value="3"> RUSAK RINGAN </option>
                                        <option value="4"> RUSAK BERAT </option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="select-perkerasan" name="perkerasan" id="list-perkerasan">
                                        <option value="0"> SEMUA PERKERASAN </option>
                                        <option value="1"> HOTMIX </option>
                                        <option value="2"> ASPAL </option>
                                        <option value="3"> BETON </option>
                                        <option value="4"> PAVING </option>
                                        <option value="5"> TANAH </option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary btn-sm">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</section>
