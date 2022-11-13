<div id="sidebar" class="leaflet-sidebar collapsed">

    <!-- nav tabs -->
    <div class="leaflet-sidebar-tabs">
        <!-- top aligned tabs -->
        <ul role="tablist">
            <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
            <li><a href="#search" role="tab"><i class="fa fa-search"></i></a></li>
            <li><a href="#profile" role="tab"><i class="fa fa-user"></i></a></li>
            <li><a href="/dashboard" role="tab"><i class="fas fa-desktop"></i></a></li>
        </ul>

        <!-- bottom aligned tabs -->
        <ul role="tablist">
            <li><a href="https://github.com/nickpeihl/leaflet-sidebar-v2"><i class="fa fa-info"></i></a></li>
        </ul>
    </div>

    <!-- panel content -->
    <div class="leaflet-sidebar-content">
        <div class="leaflet-sidebar-pane" id="home">
            <h1 class="leaflet-sidebar-header">
                Layer Control
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>

            <div id="mini-basemap"></div>
            <div id="separator">
                <hr style="width:100%;text-align:left;margin-left:0">
            </div>
            <div id="overlay"></div>
        </div>

        <div class="leaflet-sidebar-pane" id="search">
            <h1 class="leaflet-sidebar-header">
                Search
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <div id="search-ruas" class="mt-3">
                <label for="pencarianRuas">
                    <h6>Pencarian Berdasar Nomor atau Nama Ruas</h6>
                </label>
                <select name="pencarianRuas" class="no-ruas" multiple="multiple" id="no-ruas">
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                </select>
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm">Cari</button>
                </div>
            </div>
            <hr>
            <form method="" id="filter-ruas">
                {{ csrf_field() }}
                <h6> Pencarian Berdasarkan Kecamatan / Kelurahan</h6>
                <label for="kecamatan-select">
                    Pilih Kecamatan
                </label>
                <select name="kecamatan-select" class="kecamatan" id="kecamatan">
                    <option value="0">--- Pilih Kecamatan ---</option>
                </select>

                <label for="kecamatan-select">
                    Pilih Kelurahan
                </label>
                <select name="kelurahan-select" class="kelurahan mt-5" id="kelurahan" disabled>
                    <option value="0">--- Pilih Kelurahan ---</option>
                </select>
                <div class="mt-4">
                    <label for="kecamatan-select">
                        Kondisi Jalan
                    </label>
                    <div class="row mt-2" id="kondisi-cek">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="1" id="baik" checked>
                                <label class="form-check-label" for="baik">
                                    Baik
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="2" id="sedang"
                                    checked>
                                <label class="form-check-label" for="sedang">
                                    Sedang
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="3" id="rusak-ringan"
                                    checked>
                                <label class="form-check-label" for="rusak-ringan">
                                    Rusak Ringan
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="4" id="rusak-berat"
                                    checked>
                                <label class="form-check-label" for="rusak-berat">
                                    Rusak Berat
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
                <button class="btn btn-primary btn-sm">Cari</button>
            </form>

        </div>

        <div class="leaflet-sidebar-pane" id="profile">
            <h1 class="leaflet-sidebar-header">Profile Pengguna<span class="leaflet-sidebar-close"><i
                        class="fa fa-caret-left"></i></span></h1>
            <div class="mt-3" id="username">
                <h5 class="text-center">Hallo Guest</h5>
            </div>
            <div class="mt-3">
                <img src="https://xsgames.co/randomusers/avatar.php?g=male" class="mx-auto d-block" alt="..."
                    id="user-image">
            </div>
            <div class="mt-3">
                <h5 class="text-center">Guest</h5>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary btn-sm mx-auto d-block" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login</button>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success mx-auto d-block custom btn-sm">Edit</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-danger mx-auto d-block custom btn-sm">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
