<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header">
                Dashboard
            </div>
            <div class="card-body">
                <div class="mb-3 ml-2">
                    <label></label><i class="fas fa-filter mr-2"></i>Kecamatan : </label>
                    {{-- <h6>Filter </h6> --}}
                    <select class="js-example-basic-single" name="state">
                        <option value="0"> Semua Kecamatan </option>
                        <option value="WY">GARUM</option>
                        <option value="WY">KADEMANGAN</option>
                        <option value="WY">KANIGORO</option>
                        <option value="WY">NGLEGOK</option>
                        <option value="WY">SRENGAT</option>
                        <option value="WY">SUTOJAYAN</option>
                        <option value="WY">TALUN</option>
                        <option value="WY">WLINGI</option>
                    </select>
                    <label></label><i class="fas fa-filter mr-2"></i>Kelurahan : </label>
                    <select class="js-example-basic-single" name="state">
                        <option value="0"> Semua Kelurahan </option>
                        <option value="0">BENCE</option>
                        <option value="0">GARUM</option>
                        <option value="0">SUMBERDIREN</option>
                        <option value="0">TAWANGSARI</option>
                        <option value="0">KADEMANGAN</option>
                        <option value="0">KANIGORO</option>
                        <option value="0">SATREYAN</option>
                        <option value="0">NGLEGOK</option>
                        <option value="0">DANDONG</option>
                        <option value="0">KAUMAN</option>
                        <option value="0">SRENGAT</option>
                        <option value="0">TOGOGAN</option>
                        <option value="0">JEGU</option>
                        <option value="0">JINGGLONG</option>
                        <option value="0">KALIPANG</option>
                        <option value="0">KEDUNGBUNDER</option>
                        <option value="0">KEMBANGARUM</option>
                        <option value="0">SUKOREJO</option>
                        <option value="0">SUTOJAYAN</option>
                        <option value="0">KAMULAN</option>
                        <option value="0">KAWERON</option>
                        <option value="0">TALUN</option>
                        <option value="0">BABADAN</option>
                        <option value="0">BERU</option>
                        <option value="0">KLEMUNAN</option>
                        <option value="0">TANGKIL</option>
                        <option value="0">WLINGI</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{-- <div class="col-lg-3 col-6"> --}}
                        <!-- small box -->
                        <div class="card">
                            <div class="card-body">


                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>15</h3>
                                        <p>Baik</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                {{-- </div> --}}
                                <!-- ./col -->
                                {{-- <div class="col-lg-3 col-6"> --}}
                                <!-- small box -->
                                <div class="small-box" style="background: #ffc107">
                                    <div class="inner">
                                        <h3>507</h3>

                                        <p>Sedang</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                {{-- </div> --}}
                                <!-- ./col -->
                                {{-- <div class="col-lg-3 col-6"> --}}
                                <!-- small box -->
                                <div class="small-box" style="background: #fd7e14">
                                    <div class="inner">
                                        <h3>554</h3>

                                        <p>Rusak Ringan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                {{-- </div> --}}
                                <!-- ./col -->
                                {{-- <div class="col-lg-3 col-6"> --}}
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>431</h3>

                                        <p>Rusak Berat</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    {{-- </div> --}}
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="jalan-chart"
                                    style="min-height: 250px; min-height: 250px; max-height: 650px; max-width: 100%;">></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
