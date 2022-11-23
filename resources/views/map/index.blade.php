<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peta Ruas Jalan Kabupaten Blitar</title>
    {{-- bootstrap css ad js --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- leaflet css and js --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    {{-- leaflet provider --}}
    <script src="{{ asset('assets/leaflet/js/leaflet-providers.js') }}"></script>

    {{-- leaflet minimaps control layer --}}
    <script src="{{ asset('assets/leaflet/js/L.Control.Layers.Minimap.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/control.layers.minimap.css') }}" />
    {{-- leaflet geoman --}}
    <script src="{{ asset('assets/leaflet/js/leaflet-geoman.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet-geoman.css') }}" />


    {{-- fontawesome css --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e4d20a5f83.js" crossorigin="anonymous"></script>

    {{-- shp to geojson --}}
    <script src="{{ asset('assets/shp/leaflet.shpfile.js') }}"></script>
    <script src="{{ asset('assets/shp/shp.js') }}"></script>
    {{-- turf js --}}
    <script src='{{ asset('assets/turf/turf.min.js') }}'></script>
    {{-- sidebar map v2 --}}
    <script src="{{ asset('assets/map-sidebar/leaflet-sidebar.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/map-sidebar/leaflet-sidebar.css') }}" />

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- admin lte theme --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin-page/admin-lte/dist/css/adminlte.css') }}">
    <script src="{{ asset('assets/admin-page/admin-lte/dist/js/adminlte.js') }}"></script> --}}

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@3.0.8/dist/esri-leaflet.js"
        integrity="sha512-E0DKVahIg0p1UHR2Kf9NX7x7TUewJb30mxkxEm2qOYTVJObgsAGpEol9F6iK6oefCbkJiA4/i6fnTHzM6H1kEA=="
        crossorigin=""></script>

    <!-- Load Esri Leaflet Vector from CDN -->
    <script src="https://unpkg.com/esri-leaflet-vector@4.0.0/dist/esri-leaflet-vector.js"
        integrity="sha512-EMt/tpooNkBOxxQy2SOE1HgzWbg9u1gI6mT23Wl0eBWTwN9nuaPtLAaX9irNocMrHf0XhRzT8B0vXQ/bzD0I0w=="
        crossorigin=""></script>


    <style>
        html,
        body #map-container {
            height: 50%;
        }

        #map {
            /* position: absolute; */
            /* width: 100%; */
            display: block;
            position: absolute;
            height: auto;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
            /* margin-top: 55px; */
            margin-bottom: 0;
        }

        #user-image {
            border-radius: 50% !important;
            height: 150px;
            width: 150px;
        }

        .custom {
            width: 78px
        }
    </style>
</head>

<body>

    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('assets/logo/kdr-logo.png') }}" alt="AdminLTELogo" height="175"
            width="124">
    </div> --}}

    <div id="map"></div>
    {{-- @include('layouts.map.navbar') --}}
    @include('layouts.map.login')
    @include('layouts.map.details')

    @include('layouts.map.sidebar')


</body>

<script>
    var map = L.map('map').setView([-8.130866, 112.220006], 12);

    var osm = L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

    var imagery = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 18,
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        }).addTo(map);

    // var stamen = L.tileLayer.provider('Stamen.Watercolor');
    var Stadia = L.tileLayer.provider('Stadia.Outdoors');
    var Thunderforest = L.tileLayer(
        'https://{s}.tile.thunderforest.com/transport-dark/{z}/{x}/{y}.png?apikey={apikey}', {
            attribution: '&copy; <a href="http://www.thunderforest.com/">Thunderforest</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            apikey: '7c352c8ff1244dd8b732e349e0b0fe8d',
            maxZoom: 22
        });
    const apiKey =
        'AAPKb10821df102a46a4b930958d7a6a06593sdla7i0cMWoosp7XXlYflDTAxsZMUq-oKvVOaom9B8CokPvJFd-sE88vOQ2B_rC';
    var esri = L.esri.Vector.vectorBasemapLayer('ArcGIS:Imagery:Labels', {
        apikey: 'AAPKb10821df102a46a4b930958d7a6a06593sdla7i0cMWoosp7XXlYflDTAxsZMUq-oKvVOaom9B8CokPvJFd-sE88vOQ2B_rC'
    }).addTo(map);

    var baseMaps = {
        " SATELIT ": imagery,
        " OPEN STREET MAP ": osm,
        " STADIA ": Stadia,
        " THUNDERFOREST ": Thunderforest,
    }

    map.on("baselayerchange",
        function(e) {
            if (e.name == ' SATELIT ') {
                esri.addTo(map);
            } else {
                map.removeLayer(esri);
            }
        });
    // layer control (add to sidebar)

    var basemapControl = L.control.layers.minimap(baseMaps, null, {
        collapsed: false,
        topPadding: 100
    }).addTo(map);

    var htmlBasemap = basemapControl.getContainer();

    $('#mini-basemap').append(htmlBasemap);


    // popup ruan jalan on click
    var popupContent = function(property, coordinate) {
        var data = `
                    <p class="text-center fw-bold mb-0"> ` + property.nama_ruas + `</p>
                    <hr class="mb-1 mt-1">
                    <img src="{{ asset('assets/image/jalan/preview-jalan.jpg') }}" class="mb-1 rounded" style="height: 180px; width: 250px"></img>
                    <table class="table table-striped table-sm mt-2">
                        <tr>
                            <th scope="row">No. Ruas</th>
                            <td>` + property.nomor_ruas + `</td>
                        </tr>
                        <tr>
                            <th scope="row">Kelurahan</th>
                            <td>` + property.kelurahan.nama + `</td>
                        </tr>
                        <tr>
                            <th scope="row">Panjang</th>
                            <td>` + Math.round(property.panjang) + ` Meter</td>
                        </tr>
                        <tr>
                            <th scope="row">Perkerasan</th>
                            <td>` + property.perkerasan.perkerasan + `</td>
                        </tr>
                        <tr>
                            <th scope="row">Kondisi</th>
                            <td>` + property.kondisi.kondisi + `</td>
                        </tr>
                    </table>
                    <table class="table table-striped">
                        <tr>
                            <td class="text-center"><a href="#" onclick="gMaps(` + coordinate + `)" style="text-decoration: none"><i class="fas fa-map-marker-alt"></i> Maps </a></td>
                            <td class="text-center"> <a href="#" data-bs-toggle="modal" id="detailOpen" data-id="` +
            property.id + `" data-bs-target="#detailModal" style="text-decoration: none"><i class="fas fa-info-circle"></i> Detail</a></td>
                        </tr>
                    </table>
                    `;

        return data;
    }

    $("#clear").on('click', function(e) {})

    $(document).on('click', "#detailOpen", function() {
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: '/get/' + id + '/polygon',
            dataType: "json",
            success: function(get) {
                $.each(get.data, (i, data) => {
                    const coordinate = "'" + data.middle_y + ',' + data
                        .middle_x + "'"
                    $('#nama, #nomor, #lingkungan, #kelKec, #panjang, #lebar,  #perkerasan, #utilitas, #koordinat, #kondisi')
                        .html('')
                    $('#nama').append(data.nama_ruas)
                    $('#nomor').append(data.nomor_ruas)
                    $('#lingkungan').append(data.lingkungan)
                    $('#kelKec').append(data.kelurahan.nama + '/' + data.kecamatan.nama)
                    $('#panjang').append(data.panjang + ' Meter')
                    $('#lebar').append(data.lebar + ' Meter')
                    $('#perkerasan').append(data.perkerasan.perkerasan)
                    $('#utilitas').append(data.utilitas)
                    $('#koordinat').append('<a href="#" onclick="gMaps(' + coordinate +
                        ')" style="text-decoration: none">' + data.middle_x + ',' + data
                        .middle_y + '</a>')
                    $('#kondisi').append(data.kondisi.kondisi)
                })

            }
        });

        $.ajax({
            type: "GET",
            url: '/get/' + id + '/pemeliharaan',
            dataType: "json",
            success: function(get) {
                let idx = 1;
                $("#t-pemeliharaan").html("");
                $.each(get.data, (i, data) => {
                    $("#t-pemeliharaan").append(`
                    <tr>
                        <th scope="row">` + idx + `</th>
                        <td>` + data.pelaksanaan + `</td>
                        <td>` + data.penyedia.nama + `</td>
                        <td>` + data.biaya + `</td>
                        <td>` + data.keterangan + `</td>
                    </tr>`)
                    idx++;
                })

            }
        });

    })

    var style = function(k) {
        let color = {
            color: 'white',
            weight: 1.8,
            opacity: 0.9,
            dashArray: 2
        };
        if (k == 1) {
            color.color = 'white';
        } else if (k == 2) {
            color.color = 'yellow';
        } else if (k == 3) {
            color.color = 'orange';
        } else {
            color.color = 'red';
        }
        return color
    }

    var shpBatas = new L.Shapefile("{{ asset('assets/shp/SHP-BATAS-KAB-LN.zip') }}")

    shpBatas.addTo(map);
    shpBatas.options.pmIgnore = true;

    // open googlemaps in new window
    function gMaps(c) {
        url = "https://www.google.com/maps/search/" + c;
        window.open(url, '_blank');
    }
</script>

<script>
    var url = '/get/polygon';

    function clearLayer() {
        map.eachLayer(function(lay) {
            if (lay.toGeoJSON) {
                map.removeLayer(lay);
            }
        });
        shpBatas.addTo(map);
    }

    function getPolygon(url) {
        var allRuas = L.featureGroup();
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(get) {
                var data = get.data;
                $.each(data, (i, property) => {
                    var geometry = JSON.parse(property.geometry.replace(/&quot;/g, '"'))
                    var buffered = turf.buffer(geometry, 5, {
                        units: 'meters'
                    });
                    var layer = L.geoJSON(buffered, {
                        style: function(f) {
                            return style(property.kondisi_id)
                        },
                        pmIgnore: true,
                        onEachFeature: function(f, l) {
                            var out = [];
                            var coordinate = "'" + property.middle_y + ',' + property
                                .middle_x + "'";
                            if (property) {
                                l.bindPopup(popupContent(property,
                                    coordinate), {
                                    maxWidth: "250",
                                    maxHeigth: "auto"
                                });
                            }
                        }
                    });
                    layer.addTo(allRuas);
                })
                allRuas.addTo(map);
                map.fitBounds(allRuas.getBounds());
            }
        });
    };

    getPolygon(url);

    function ruasId() {
        $.ajax({
            type: "GET",
            url: '/get/ruas/select',
            dataType: "json",
            success: function(ruas) {
                var listItems = ""
                $.each(ruas.data, (i, data) => {
                    listItems += "<option value='" + data.id + "'>" + data.nama + " - Ruas No  " +
                        data
                        .id +
                        "</option>"
                })
                $("#no-ruas").append(listItems);
            }
        });
    }
    ruasId();

    function kecamatan() {
        $.ajax({
            type: "GET",
            url: '/get/kecamatan',
            dataType: "json",
            success: function(kec) {
                var kecamatan = kec.data,
                    listItems = ""
                $.each(kecamatan, (i, property) => {
                    listItems += "<option value='" + property.id + "'>" + property
                        .nama +
                        "</option>"
                })
                $("#kecamatan").append(listItems);
            }
        });
    }
    kecamatan();

    function kelurahan(id) {
        url = '/get/kelurahan/' + id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(kel) {
                var kelurahan = kel.data,
                    listItems = ""
                $.each(kelurahan, (i, property) => {
                    listItems += "<option value='" + property.id + "'>" + property
                        .nama +
                        "</option>"
                })
                $("#kelurahan").append(listItems);
            }
        });
    }

    $('#kecamatan').on('change', function() {
        $("#kelurahan").html("<option value=0>--- Pilih Kelurahan ---</option>")
        var id = this.value;
        (id == 0) ? $("#kelurahan").prop({
            "disabled": true
        }): $("#kelurahan").prop({
            "disabled": false
        })
        kelurahan(id);
    });

    // pencarian filter-ruas by no ruas
    $("#ruas-satuan").on('click', function(e) {
        e.preventDefault();
        var ruas = $('.no-ruas').val();
        clearLayer();
        url = '/get/' + ruas + '/ruas'
        getPolygon(url)
    })

    // pencarian filter-ruas by kecamatan
    $("#filter-ruas").on('submit', function(e) {
        e.preventDefault();
        var kecamatan = $('#kecamatan').val();
        var kelurahan = $('#kelurahan').val();
        var kondisi = $("#kondisi-cek input:checkbox:checked").map(function() {
            return $(this).val();
        }).get();
        clearLayer();
        url = '/get/' + kecamatan + '/' + kelurahan + '/' + kondisi
        getPolygon(url)
    })
</script>

<script>
    var sidebar = L.control.sidebar({
            autopan: false,
            container: 'sidebar',
            position: 'right',
        })
        .addTo(map)
        .close();

    // be notified when a panel is opened
    sidebar.on('content', function(ev) {
        switch (ev.id) {
            case 'autopan':
                sidebar.options.autopan = false;
                break;
            default:
                sidebar.options.autopan = false;
        }
    });

    var userid = 0

    function addUser() {
        sidebar.addPanel({
            id: 'user' + userid++,
            tab: '<i class="fa fa-user"></i>',
            title: 'User Profile ' + userid,
            pane: '<p>user ipsum dolor sit amet</p>',
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('.no-ruas').select2({
            placeholder: "Masukkan No/Nama Ruas..",
            width: '100%',
            theme: 'classic',
            dropdownParent: $("#search")
        });
        $('.kecamatan').select2({
            width: '100%',
            theme: 'classic',
            dropdownParent: $("#search")
        });
        $('.kelurahan').select2({
            width: '100%',
            theme: 'classic',
            dropdownParent: $("#search")
        });

    });

    // LEAFLET GEOMAN

    // add draw control

    map.pm.addControls({
        position: 'topleft',
        drawMarker: false,
        drawRectangle: false,
        drawCircleMarker: false,
        drawText: false,
        dragMode: false,
        cutPolygon: false,
        rotateMode: false
    });

    // listen draw on create

    map.on("pm:create", (e) => {
        var ukur = (e) => {
            var layer = e.layer,
                shape = e.shape,
                nf = Intl.NumberFormat();
            if (shape === 'Polygon') {
                var seeArea = turf.area(layer.toGeoJSON());
                var ha = seeArea / 10000;
                var mPersegi = seeArea;
                if (mPersegi > 10000) {
                    layer.bindPopup("Luas " + nf.format(ha.toFixed(2)) + " Ha");
                } else {
                    layer.bindPopup("Luas " + nf.format(mPersegi.toFixed(2)) + " Meter²");
                }
            }

            if (shape === 'Line') {

                var seeArea = turf.length(layer.toGeoJSON());
                var meter = seeArea * 1000;
                var kilometer = seeArea;
                if (meter < 1000) {
                    layer.bindPopup("Jarak " + nf.format(meter.toFixed(2)) + " Meter");
                } else {
                    layer.bindPopup("Jarak " + nf.format(kilometer.toFixed(2)) + " Kilometer");
                }
            }

            if (shape === 'Circle') {
                console.log(layer._mRadius)
                if (layer._mRadius < 1000) {
                    layer.bindPopup("Radius " + nf.format(layer._mRadius.toFixed(2)) + " Meter");
                } else {
                    layer.bindPopup("Radius " + nf.format((layer._mRadius / 1000).toFixed(2)) +
                        " Kilometer");
                }
            }
        }
        ukur(e);
        e.layer.on("pm:edit", (e) => {
            ukur(e);
        })
    })
</script>

</html>
