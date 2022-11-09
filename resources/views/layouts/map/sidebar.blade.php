<div id="sidebar" class="leaflet-sidebar collapsed">

    <!-- nav tabs -->
    <div class="leaflet-sidebar-tabs">
        <!-- top aligned tabs -->
        <ul role="tablist">
            <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
            <li><a href="#search" role="tab"><i class="fa fa-search"></i></a></li>
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
                <select name="pencarianRuas" class="no-ruas" id="no-ruas">
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
                <button class="btn btn-primary">Cari</button>
            </div>
            <hr>
            <div id="filter-ruas">
                <h6> Pencarian Berdasarkan Kecamatan / Kelurahan</h6>
                <label for="kecamatan-select">
                    Pilih Kecamatan
                </label>
                <select name="kecamatan-select" class="kecamatan" id="kecamatan">
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                </select>

                <label for="kecamatan-select">
                    Pilih Kelurahan
                </label>
                <select name="kelurahan-select" class="kelurahan mt-5" id="kelurahan">
                    <option value="1">Kanigoro</option>
                    <option value="2">Srengat</option>
                    <option value="3">Wlingi</option>
                </select>

                <label for="kecamatan-select">
                    Kondisi Jalan
                </label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="" id="baik" checked>
                    <label class="form-check-label" for="baik">
                        Baik
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="" id="sedang" checked>
                    <label class="form-check-label" for="sedang">
                        Sedang
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="" id="rusak-ringan" checked>
                    <label class="form-check-label" for="rusak-ringan">
                        Rusak Ringan
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="" id="rusak-berat" checked>
                    <label class="form-check-label" for="rusak-berat">
                        Rusak Berat
                    </label>
                </div>

                <button class="btn btn-primary">Cari</button>
            </div>

        </div>

        <div class="leaflet-sidebar-pane" id="messages">
            <h1 class="leaflet-sidebar-header">Messages<span class="leaflet-sidebar-close"><i
                        class="fa fa-caret-left"></i></span></h1>
        </div>
    </div>
</div>
