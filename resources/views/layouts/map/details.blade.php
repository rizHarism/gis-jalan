<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTitle">Properti Ruas Jalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Detail Data</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-pemeliharaan" type="button" role="tab"
                                aria-controls="nav-profile" aria-selected="false">Pemeliharaan</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-detail" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="mt-2" id="detailData">
                                <table class="table table-sm table-striped">
                                    <tr>
                                        <th>Nama Ruas </th>
                                        <td id="nama_ruas">Jalan Cimandiri</td>
                                    </tr>
                                    <tr>
                                        <th>No Ruas </th>
                                        <td id="nomor_ruas">170</td>
                                    </tr>
                                    <tr>
                                        <th>Lingkungan </th>
                                        <td id="lingkungan">Bence</td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan / Kecamatan </th>
                                        <td id="kelKec">Bence / Garum</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang </th>
                                        <td id="panjang">39 Meter</td>
                                    </tr>
                                    <tr>
                                        <th>Lebar </th>
                                        <td id="lebar">3 Meter</td>
                                    </tr>
                                    <tr>
                                        <th>Tipe Perkerasan </th>
                                        <td id="perkerasan">Aspal</td>
                                    </tr>
                                    <tr>
                                        <th>Utilitas </th>
                                        <td id="utilitas">Bahu Jalan</td>
                                    </tr>
                                    <tr>
                                        <th>Koordinat Center </th>
                                        <td id="koordinat">-8.06578902654 , 112.233218589</td>
                                    </tr>
                                    <tr>
                                        <th>Kondisi Jalan </th>
                                        <td id="kondisi">Rusak Berat</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-pemeliharaan" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <div class="mt-2" id="pemeliharaan">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tanggal Pemeliharaan</th>
                                            <th scope="col">Penyedia Jasa</th>
                                            <th scope="col">Anggaran</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="t-pemeliharaan">
                                        {{-- <tr>
                                            <th scope="row">1</th>
                                            <td>15-02-2020</td>
                                            <td>CV. Jaya Bersama</td>
                                            <td>Rp 280.000.000</td>
                                            <td>Perataan Ruas Jalan</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>20-02-2021</td>
                                            <td>CV. Lingkar Satu</td>
                                            <td>Rp 400.000.000</td>
                                            <td>Aspal Ulang</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>30-02-2022</td>
                                            <td>CV. Bangun Raharja</td>
                                            <td>Rp 321.000.000</td>
                                            <td>Penambalan lubang dan penggunaan bahu jalan</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- </div>
                    </div> --}}

                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"></button> --}}
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="flyer-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header"> --}}
            {{-- <h5 class="modal-title" id="titleModal">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            {{-- </div> --}}
            <div class="modal-body">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/38/Worldmap-blank.svg" class="img-fluid"
                    alt="world-map">
                <h3 class="d-flex justify-content-center">JALIN GETAR</h3>
                <h6 class="d-flex justify-content-center fst-italic">Jalan Lingkungan Geosptatial Kabupaten Blitar</h6>
            </div>
        </div>
    </div>
</div>
