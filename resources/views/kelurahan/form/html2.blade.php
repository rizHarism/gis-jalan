<section class="content">
    <div class="card">
        {{-- <div class="card-header">{{ isset($edit) ? 'Edit Data Ruas Jalan' : 'Tambah Data Ruas Jalan' }}</div> --}}
        <div class="card-body">
            <div class="container-fluid mt-0 pt-0">
                <div class="row">
                    <div class="col-6 border rounded map p-3">
                        <p class="h5 font-italic font-weight-bold">
                            {{ isset($edit) ? 'Edit Data Ruas Jalan' : 'Tambah Data Ruas Jalan' }}</p>
                        <hr>
                        <div id="map">
                        </div>
                    </div>
                    <div class="col-6 border rounded p-3">
                        <p class="h5 font-italic font-weight-bold">Informasi Ruas</p>
                        <hr>
                        <form id="ruas-form" method="{{ isset($edit) ? 'PUT' : 'POST' }}"
                            action="{{ isset($edit) ? '/ruas/kelurahan/' . $edit['id'] . '/update' : '/ruas/kelurahan/store' }}"
                            class="">
                            @method('PUT')
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="namaRuas">Nomor Ruas
                                            :</label>
                                        <input type="text" class="form-control form-control-sm" id="nomorRuas"
                                            value="{{ $edit['nomor_ruas'] ?? $last_ruas }}" placeholder="Nomor Ruas"
                                            required disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="namaRuas">Nama Ruas :</label>
                                        <input type="text" class="form-control form-control-sm" id="namaRuas"
                                            value="{{ $edit['nama_ruas'] ?? '' }}" placeholder="Nama Ruas" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="pangkalRuas">Pangkal Ruas
                                            :</label>
                                        <input type="text" class="form-control form-control-sm" id="pangkalRuas"
                                            value="{{ $edit['pangkal_ruas'] ?? '' }}" placeholder="Pangkal Ruas"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="ujungRuas">Ujung Ruas
                                            :</label>
                                        <input type="text" class="form-control form-control-sm" id="ujungRuas"
                                            value="{{ $edit['ujung_ruas'] ?? '' }}" placeholder="Ujung Ruas" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="lingkungan">Lingkungan
                                            :</label>
                                        <input type="text" class="form-control form-control-sm" id="lingkungan"
                                            value="{{ $edit['lingkungan'] ?? '' }}" placeholder="Lingkungan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="kecamatan">Kecamatan
                                            :</label>
                                        <select class="form-control form-control-sm" name="kecamatan"
                                            id="list-kecamatan" required>
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @foreach ($kecamatan as $_kecamatan)
                                                <option value="{{ $_kecamatan['id'] }}"
                                                    {{ isset($edit) && $edit['kecamatan_id'] == $_kecamatan['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_kecamatan['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="kelurahan">Kelurahan
                                            :</label>
                                        <select class="form-control form-control-sm" name="kelurahan"
                                            id="list-kelurahan" {{ isset($edit) ? 'enabled' : 'disabled' }} required>
                                            <option value="">-- Pilih Kelurahan --</option>
                                            @foreach ($kelurahan as $_kelurahan)
                                                <option value="{{ $_kelurahan['id'] }}"
                                                    {{ isset($edit) && $edit['kelurahan_id'] == $_kelurahan['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_kelurahan['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="font-italic font-weight-normal" for="panjang">Panjang
                                                    <sup>(m)</sup> : </label>
                                                <input type="number" class="form-control form-control-sm"
                                                    id="panjang" value="{{ $edit['panjang'] ?? '' }}"
                                                    placeholder="Panjang Ruas" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="font-italic font-weight-normal" for="lebar">Lebar
                                                    <sup>(m)</sup> :</label>
                                                <input type="number" class="form-control form-control-sm"
                                                    id="lebar" value="{{ $edit['lebar'] ?? '' }}"
                                                    placeholder="Lebar Ruas" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="bahuJalan">Bahu Jalan
                                            <sup>(m)</sup>:</label>
                                        <div class="row" id="bahuJalan">
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm"
                                                    id="bahuKanan" value="{{ $edit['bahu_kanan'] ?? '' }}"
                                                    placeholder="Kanan" required>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm"
                                                    id="bahuKiri" value="{{ $edit['bahu_kiri'] ?? '' }}"
                                                    placeholder="Kiri" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="kondisi">Kondisi :</label>
                                        <select class="form-control form-control-sm" name="kondisi" id="kondisi"
                                            required>
                                            <option value="">-- Pilih Kondisi Jalan --</option>
                                            @foreach ($kondisi as $_kondisi)
                                                <option value="{{ $_kondisi['id'] }}"
                                                    {{ isset($edit) && $edit['kondisi_id'] == $_kondisi['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_kondisi['kondisi'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="perkerasan">Perkerasan
                                            :</label>
                                        <select class="form-control form-control-sm" name="perkerasan"
                                            id="perkerasan" required>
                                            <option value="">-- Pilih perkerasan Jalan --</option>
                                            @foreach ($perkerasan as $_perkerasan)
                                                <option value="{{ $_perkerasan['id'] }}"
                                                    {{ isset($edit) && $edit['perkerasan_id'] == $_perkerasan['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $_perkerasan['perkerasan'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal" for="utilitas">Utilitas
                                            :</label>
                                        <input type="text" class="form-control form-control-sm" id="utilitas"
                                            value="{{ $edit['utilitas'] ?? '' }}" placeholder="Utilitas Jalan">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-italic font-weight-normal">Foto Ruas :
                                        </label>
                                        <div class="p-2">
                                            <label for="image-input">
                                                <a title="Foto Ruas">
                                                    <img id="foto-ruas"
                                                        src="{{ isset($edit) ? asset('assets/image/ruas-jalan/' . $edit['image']) : asset('assets/image/ruas-jalan/default.jpg') }}"
                                                        alt="Ruas" class="rounded img-fluid"
                                                        style="cursor:pointer">
                                                </a>
                                            </label>
                                            <p class="" style="font-style: italic; font-size: 12px">
                                                *klik untuk merubah foto</p>
                                            <input id="image-input" type="file" style="display: none;"
                                                accept="image/png, image/jpg, image/jpeg" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right ml-2 custom"
                                id="simpan-ruas">Simpan</button>
                            <button type="button" class="btn btn-secondary float-right custom">Batal</button>
                            {{-- </div> --}}
                            {{-- </div> --}}
                            <div class="form-group">
                                {{-- <label class="font-italic font-weight-normal" for="geometry">geometry :</label> --}}
                                <textarea class="form-control" id="geometry" rows="3" hidden>{{ $edit['geometry'] ?? '' }}</textarea>
                                {{-- <label class="font-italic font-weight-normal" for="startx">startx :</label> --}}
                                <input type="hidden" class="form-control form-control-sm" id="startx"
                                    value="{{ $edit['start_x'] ?? '' }}">
                                {{-- <label class="font-italic font-weight-normal" for="starty">starty :</label> --}}
                                <input type="hidden" class="form-control form-control-sm" id="starty"
                                    value="{{ $edit['start_y'] ?? '' }}">
                                {{-- <label class="font-italic font-weight-normal" for="startx">midx :</label> --}}
                                <input type="hidden" class="form-control form-control-sm" id="midx"
                                    value="{{ $edit['middle_x'] ?? '' }}">
                                {{-- <label class="font-italic font-weight-normal" for="starty">midy :</label> --}}
                                <input type="hidden" class="form-control form-control-sm" id="midy"
                                    value="{{ $edit['middle_y'] ?? '' }}">
                                {{-- <label class="font-italic font-weight-normal" for="startx">endx :</label> --}}
                                <input type="hidden" class="form-control form-control-sm" id="endx"
                                    value="{{ $edit['end_x'] ?? '' }}">
                                {{-- <label class="font-italic font-weight-normal" for="starty">endy :</label> --}}
                                <input type="hidden" class="form-control form-control-sm" id="endy"
                                    value="{{ $edit['end_y'] ?? '' }}">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


</section>
