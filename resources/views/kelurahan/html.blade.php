<section class="content">
    <div class="card">
        <div class="card-header">Data Ruas Jalan Kelurahan</div>
        <div class="card-body">
            <div>
                <form method="" action="" id="filter-datatables">
                    {{ csrf_field() }}
                    <div class="mb-3 mt-0">
                        <i class="fas fa-search mr-2"></i>
                        <select class="select-kecamatan" name="kecamatan" id="list-kecamatan">
                            <option value="0"> SEMUA KECAMATAN </option>
                        </select>
                        <select class="select-kelurahan" name="kelurahan" id="list-kelurahan" disabled>
                            <option value="0"> SEMUA KELURAHAN </option>
                        </select>
                        <select class="select-kondisi" name="kondisi" id="list-kondisi">
                            <option value="0"> SEMUA KONDISI </option>
                            <option value="1"> BAIK </option>
                            <option value="2"> SEDANG </option>
                            <option value="3"> RUSAK RINGAN </option>
                            <option value="4"> RUSAK BERAT </option>
                        </select>
                        <select class="select-perkerasan" name="perkerasan" id="list-perkerasan">
                            <option value="0"> SEMUA PERKERASAN </option>
                            <option value="1"> HOTMIX </option>
                            <option value="2"> ASPAL </option>
                            <option value="3"> BETON </option>
                            <option value="4"> PAVING </option>
                            <option value="5"> TANAH </option>
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
