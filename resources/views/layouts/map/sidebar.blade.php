<div id="sidebar" class="leaflet-sidebar collapsed">

    <!-- nav tabs -->
    <div class="leaflet-sidebar-tabs">
        <!-- top aligned tabs -->
        <ul role="tablist">
            <li><a href="#home" role="tab" title="Peta Dasar"><i class="fa fa-bars active"></i></a></li>
            <li><a href="#search" role="tab" title="Pencarian"><i class="fa fa-search"></i></a></li>
            <li><a href="#profile" role="tab" title="Profil"><i class="fa fa-user"></i></a></li>
            @if (Auth::check())
                <li><a href="/dashboard" role="tab" title="Dashboard"><i class="fas fa-desktop"></i></a></li>
            @else
                <li><a href="" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-sign-in"
                            title="Login"></i></a></li>
            @endif
        </ul>

        <!-- bottom aligned tabs -->
        <ul role="tablist">
            <li><a href=""><i class="fa fa-info"></i></a></li>
        </ul>
    </div>

    <!-- panel content -->
    <div class="leaflet-sidebar-content">
        <div class="leaflet-sidebar-pane" id="home">
            <h1 class="leaflet-sidebar-header">
                Peta Dasar
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="col">
                        <h6>Silahkan Pilih Salah Satu Peta Dasar</h6>
                        <div id="mini-basemap"></div>
                    </div>
                    <div id="overlay"></div>
                </div>
            </div>
        </div>

        <div class="leaflet-sidebar-pane" id="search">
            <h1 class="leaflet-sidebar-header">
                Pencarian Ruas
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <div class="card mt-2">
                <div class="card-body">
                    <form id="cari-satuan" method="" class="mt-2">
                        <div id="search-ruas" class="">
                            <label for="pencarianRuas">
                                <h6>Pencarian Berdasar Nomor atau Nama Ruas</h6>
                            </label>
                            <select name="pencarianRuas" class="no-ruas" multiple="multiple" id="no-ruas" required>
                            </select>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm custom"
                                    id="ruas-satuan">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form method="" class="" id="filter-ruas">
                        {{ csrf_field() }}
                        <h6> Pencarian Berdasarkan Kecamatan / Kelurahan</h6>
                        <div class="">
                            <label for="kecamatan-select">
                                Pilih Kecamatan
                            </label>
                            <select name="kecamatan-select" class="kecamatan" id="kecamatan">
                                <option value="0">--- Pilih Kecamatan ---</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="kecamatan-select">
                                Pilih Kelurahan
                            </label>
                            <select name="kelurahan-select" class="kelurahan" id="kelurahan" disabled>
                                <option value="0">--- Pilih Kelurahan ---</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="kecamatan-select">
                                Kondisi Jalan
                            </label>
                            <div class="row mt-2" id="kondisi-cek">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" id="baik"
                                            checked>
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
                                        <input class="form-check-input" type="checkbox" value="3"
                                            id="rusak-ringan" checked>
                                        <label class="form-check-label" for="rusak-ringan">
                                            Rusak Ringan
                                        </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="4"
                                            id="rusak-berat" checked>
                                        <label class="form-check-label" for="rusak-berat">
                                            Rusak Berat
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="kecamatan-select">
                                Tipe Perkerasan
                            </label>
                            <div class="row mt-2" id="perkerasan-cek">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="hotmix" checked>
                                        <label class="form-check-label" for="hotmix">
                                            Hotmix
                                        </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            id="aspal" checked>
                                        <label class="form-check-label" for="aspal">
                                            Aspal
                                        </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="3"
                                            id="beton" checked>
                                        <label class="form-check-label" for="beton">
                                            Beton
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 justify-content-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="4"
                                            id="paving" checked>
                                        <label class="form-check-label" for="paving">
                                            Paving
                                        </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="5"
                                            id="tanah" checked>
                                        <label class="form-check-label" for="tanah">
                                            Tanah
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-sm custom">Cari</button>
                                </div>
                                <div
                                    class="col-7 border rounded rounded-2 d-flex align-items-center justify-content-center bg-light">
                                    <div id="jumlah-ruas" class="h7 fst-italic">Jumlah Ruas : 1507</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form id="find-coordinate" method="" class="">
                        <div id="search-ruas" class="">
                            <label for="pencarianRuas">
                                <h6>Pencarian Koordinat</h6>
                            </label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <label for="latitude" class="form-label">Latitude :</label>
                                        <input type="text" class="form-control form-control-sm" id="latitude"
                                            placeholder="-8.7654321" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <label for="longitude" class="form-label">Longitude :</label>
                                        <input type="text" class="form-control form-control-sm" id="longitude"
                                            placeholder="12.9876543" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm custom"
                                    id="cari-koordinat">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="leaflet-sidebar-pane" id="profile">
            @php
                if (Auth::check()) {
                    $avatar = Auth::user()->avatar;
                    $username = Auth::user()->username;
                    $name = Auth::user()->name;
                } else {
                    $avatar = 'avatar-default.png';
                    $username = 'Guest';
                    $name = '';
                }
            @endphp
            <h1 class="leaflet-sidebar-header">Profile Pengguna<span class="leaflet-sidebar-close"><i
                        class="fa fa-caret-left"></i></span></h1>
            <div class="card mt-2 ">
                <div class="card-body">
                    <div class="mt-3" id="username">
                        <h5 class="text-center">Hallo {{ $username }}</h5>
                    </div>
                    <div class="mt-3">
                        <img src="{{ asset("assets/image/avatar/$avatar") }}" class="mx-auto d-block" alt="..."
                            id="user-image">
                    </div>
                    <div class="mt-3">
                        <h5 class="text-center">{{ $username }}</h5>
                        <h6 class="text-center">{{ $name }}</h6>
                    </div>
                    @if (Auth::check() == false)
                        <div class="mt-3 mb-3">
                            <button class="btn btn-primary btn-sm mx-auto d-block" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Login</button>
                        </div>
                    @endif
                    @if (Auth::check() == true)
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <button class="btn btn-danger mx-auto d-block custom btn-sm mt-3 mb-3"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="card-overlay">
    <div class="row">
        <div class="col-1">
            <img src="{{ asset('assets/image/logo/logo-kab.svg') }}" class="img-logo" style="margin-left: -0.6vw"
                alt="">
        </div>
        <div class="col-11 d-flex align-items-center">
            <div class="title-dinas" style="margin-left: 1.5vw">
                <p class="fw-bolder fst-italic mb-0" style="font-size:1vw">DINAS PERUMAHAN RAKYAT DAN KAWASAN
                    PERMUKIMAN
                </p>
                <hr class="m-0">
                <p class="mb-0 fw-bolder fst-italic mt-0" style="font-size:0.8vw">KABUPATEN BLITAR</p>
            </div>
        </div>
    </div>
</div>
