<section class="content">
    <div class="card">
        <div class="card-header">{{ isset($edit) ? 'Edit Data Ruas Jalan' : 'Tambah Data Ruas Jalan' }}</div>
        <div class="card-body">
            <hr>
            <div class="containr">
                <div class="row">
                    <div class="col-6">
                        <div id="map" style="height: 70vh">
                        </div>
                        <div>
                            <div class="form-group">
                                <label class="font-italic font-weight-normal" for="geometry">geometry :</label>
                                <textarea class="form-control" id="geometry" rows="3">{{ $edit['geometry'] ?? '' }}</textarea>
                                <label class="font-italic font-weight-normal" for="startx">startx :</label>
                                <input type="text" class="form-control form-control-sm" id="startx"
                                    value="{{ $edit['start_x'] ?? '' }}">
                                <label class="font-italic font-weight-normal" for="starty">starty :</label>
                                <input type="text" class="form-control form-control-sm" id="starty"
                                    value="{{ $edit['start_y'] ?? '' }}">
                                <label class="font-italic font-weight-normal" for="startx">midx :</label>
                                <input type="text" class="form-control form-control-sm" id="midx"
                                    value="{{ $edit['middle_x'] ?? '' }}">
                                <label class="font-italic font-weight-normal" for="starty">midy :</label>
                                <input type="text" class="form-control form-control-sm" id="midy"
                                    value="{{ $edit['middle_y'] ?? '' }}">
                                <label class="font-italic font-weight-normal" for="startx">endx :</label>
                                <input type="text" class="form-control form-control-sm" id="endx"
                                    value="{{ $edit['end_x'] ?? '' }}">
                                <label class="font-italic font-weight-normal" for="starty">endy :</label>
                                <input type="text" class="form-control form-control-sm" id="endy"
                                    value="{{ $edit['end_y'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <form class="">
                            <div class="form-group">
                                <label class="font-italic font-weight-normal" for="namaRuas">Nama Ruas :</label>
                                <input type="text" class="form-control form-control-sm" id="namaRuas"
                                    value="{{ $edit['nama_ruas'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="font-italic font-weight-normal" for="pangkalRuas">Pangkal Ruas :</label>
                                <input type="text" class="form-control form-control-sm" id="pangkalRuas"
                                    value="{{ $edit['pangkal_ruas'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="font-italic font-weight-normal" for="ujungRuas">Ujung Ruas :</label>
                                <input type="text" class="form-control form-control-sm" id="ujungRuas"
                                    value="{{ $edit['ujung_ruas'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="font-italic font-weight-normal" for="lingkungan">Lingkungan :</label>
                                <input type="text" class="form-control form-control-sm" id="lingkungan"
                                    value="{{ $edit['lingkungan'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="font-italic font-weight-normal" for="kecamatan">Kecamatan
                                            :</label>
                                        <select class="form-control form-control-sm" name="kecamatan"
                                            id="list-kecamatan">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @foreach ($kecamatan as $_kecamatan)
                                                <option value="{{ $_kecamatan['id'] }}"
                                                    {{ isset($edit) && $edit['kecamatan_id'] == $_kecamatan['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_kecamatan['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="font-italic font-weight-normal" for="kelurahan">Kelurahan
                                            :</label>
                                        <select class="form-control form-control-sm" name="kelurahan"
                                            id="list-kelurahan" {{ isset($edit) ? 'enabled' : 'disabled' }}>
                                            <option value="">-- Pilih Kelurahan --</option>
                                            @foreach ($kelurahan as $_kelurahan)
                                                <option value="{{ $_kelurahan['id'] }}"
                                                    {{ isset($edit) && $edit['kelurahan_id'] == $_kelurahan['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_kelurahan['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="panjang">Panjang :</label>
                                        <input type="number" class="form-control form-control-sm" id="panjang"
                                            value="{{ $edit['panjang'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="lebar">Lebar :</label>
                                        <input type="number" class="form-control form-control-sm" id="lebar"
                                            value="{{ $edit['lebar'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="bahuJalan">Bahu Jalan
                                            :</label>
                                        <input type="text" class="form-control form-control-sm" id="bahuJalan"
                                            value="{{ $edit['bahu_jalan'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="kondisi">Kondisi :</label>
                                        <select class="form-control form-control-sm" name="kondisi" id="kondisi">
                                            <option value="">-- Pilih Kondisi Jalan --</option>
                                            @foreach ($kondisi as $_kondisi)
                                                <option value="{{ $_kondisi['id'] }}"
                                                    {{ isset($edit) && $edit['kondisi_id'] == $_kondisi['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_kondisi['kondisi'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="perkerasan">Perkerasan
                                            :</label>
                                        <select class="form-control form-control-sm" name="perkerasan"
                                            id="perkerasan">
                                            <option value="">-- Pilih perkerasan Jalan --</option>
                                            @foreach ($perkerasan as $_perkerasan)
                                                <option value="{{ $_perkerasan['id'] }}"
                                                    {{ isset($edit) && $edit['perkerasan_id'] == $_perkerasan['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_perkerasan['perkerasan'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-italic font-weight-normal" for="utilitas">Utilitas :</label>
                                <input type="text" class="form-control form-control-sm" id="utilitas"
                                    value="{{ $edit['utilitas'] ?? '' }}">
                            </div>

                            <button type="submit" class="btn btn-primary float-right custom">Simpan</button>
                            <button type="button" class="btn btn-secondary float-right mr-4 custom">Batal</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
