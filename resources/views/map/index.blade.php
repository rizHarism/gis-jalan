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

    var stamen = L.tileLayer.provider('Stamen.Watercolor');


    var baseMaps = {
        " SATELIT ": imagery,
        " OPEN STREET MAP ": osm,
        " STAMEN ": stamen,
    }



    // layer control (add to sidebar)

    var overlayControl = L.control.layers(null, null, {
        collapsed: false,
        autoZIndex: false
    }).addTo(map);

    var basemapControl = L.control.layers.minimap(baseMaps, null, {
        collapsed: false,
        topPadding: 100
    }).addTo(map);

    var htmlObjectBasemap = basemapControl.getContainer();
    var htmlObjectOverlay = overlayControl.getContainer();

    var bm = document.getElementById('mini-basemap');
    var ol = document.getElementById('overlay');

    function setParentLayer(el, newParent) {
        newParent.appendChild(el);
    }
    setParentLayer(htmlObjectBasemap, bm);
    setParentLayer(htmlObjectOverlay, ol);

    // end of layer control script
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
                            <td class="text-center"> <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal" style="text-decoration: none"><i class="fas fa-info-circle"></i> Detail</a></td>
                        </tr>
                    </table>
                    `;
        // console.log(properties.No__Ruas);

        return data;
    }

    $("#clear").on('click', function(e) {
        console.log(e)
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

    // open googlemaps in new window
    function gMaps(c) {
        // console.log(c)
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
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(get) {
                var data = get.data;
                $.each(data, (i, property) => {
                    // remove quote from text and parse to json
                    var geometry = JSON.parse(property.geometry.replace(/&quot;/g, '"'))
                    // console.log(geometry);
                    var buffered = turf.buffer(geometry, 5, {
                        units: 'meters'
                    });
                    // var bufferedLayer = L.geoJSON(null);
                    // bufferedLayer.addData(buffered);
                    var layer = L.geoJSON(buffered, {
                        style: function(f) {
                            return style(property.kondisi_id)
                        },
                        onEachFeature: function(f, l) {
                            var out = [];
                            var coordinate = "'" + property.middle_y + ',' + property
                                .middle_y + "'";
                            if (property) {
                                l.bindPopup(popupContent(property,
                                    coordinate), {
                                    maxWidth: "250",
                                    maxHeigth: "auto"
                                });
                            }
                        }
                        // pmIgnore: true
                    });
                    layer.addTo(map);
                })
            }
        });
    };

    getPolygon(url);

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

    // pencarian filter-ruas
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
            container: 'sidebar',
            position: 'right',
            autopan: true
        })
        .addTo(map)
        .close();

    // add panels dynamically to the sidebar
    // sidebar
    //     .addPanel({
    //         id: 'js-api',
    //         tab: '<i class="fa fa-gear"></i>',
    //         title: 'JS API',
    //         pane: '<p>The Javascript API allows to dynamically create or modify the panel state.<p/><p><button onclick="sidebar.enablePanel(\'mail\')">enable mails panel</button><button onclick="sidebar.disablePanel(\'mail\')">disable mails panel</button></p><p><button onclick="addUser()">add user</button></b>',
    //     })
    // add a tab with a click callback, initially disabled
    // .addPanel({
    //     id: 'mail',
    //     tab: '<i class="fa fa-envelope"></i>',
    //     title: 'Messages',
    //     button: function() {
    //         alert('opened via JS callback')
    //     },
    //     disabled: false,
    // })

    // be notified when a panel is opened
    sidebar.on('content', function(ev) {
        switch (ev.id) {
            case 'autopan':
                sidebar.options.autopan = true;
                break;
            default:
                sidebar.options.autopan = true;
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
            width: '100%',
            theme: 'classic',
            dropdownParent: $("#search")
        });
    });
    $(document).ready(function() {
        $('.kecamatan').select2({
            width: '100%',
            theme: 'classic',
            dropdownParent: $("#search")
        });
    });
    $(document).ready(function() {
        $('.kelurahan').select2({
            width: '100%',
            theme: 'classic',
            dropdownParent: $("#search")
        });
    });
</script>

</html>
