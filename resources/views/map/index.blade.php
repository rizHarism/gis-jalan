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
    {{-- fontawesome css --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e4d20a5f83.js" crossorigin="anonymous"></script>

    {{-- shp to geojson --}}
    <script src="{{ asset('assets/shp/leaflet.shpfile.js') }}"></script>
    <script src="{{ asset('assets/shp/shp.js') }}"></script>
    {{-- turf js --}}
    <script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>
    {{-- sidebar map v2 --}}
    <script src="{{ asset('assets/map-sidebar/leaflet-sidebar.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/map-sidebar/leaflet-sidebar.css') }}" />
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
            margin-top: 55px;
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <div id="map"></div>
    @include('layouts.map.navbar')
    @include('layouts.map.login')
    @include('layouts.map.details')

    {{-- @include('layouts.map.sidebar') --}}

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


    var baseMaps = {
        " SATELIT ": imagery,
        " OPEN STREET MAP ": osm,
    }


    // layer control (add to sidebar)

    var layersControl = L.control.layers(baseMaps, null, {
        collapsed: true,
        autoZIndex: false
    }).addTo(map);

    // var htmlObjectOverlay = layersControl.getContainer();

    // var a = document.getElementById('home');


    // function setParentLayer(el, newParent) {
    //     newParent.appendChild(el);
    // }
    // setParentLayer(htmlObjectOverlay, a);

    // end of layer control script
    var popupContent = function(properties, coordinate) {
        console.log(properties)
        var data = `
                    <p class="text-center fw-bold mb-0"> ` + properties.Nama_Ruas + `</p>
                    <hr class="mb-1 mt-1">
                    <img src="{{ asset('assets/image/jalan/preview-jalan.jpg') }}" class="mb-1 rounded" style="height: 180px; width: 250px"></img>
                    <table class="table table-striped table-sm mt-2">
                        <tr>
                            <th scope="row">No. Ruas</th>
                            <td>` + properties.No__Ruas + `</td>
                        </tr>
                        <tr>
                            <th scope="row">Kelurahan</th>
                            <td>` + properties.Kelurahan + `</td>
                        </tr>
                        <tr>
                            <th scope="row">Panjang</th>
                            <td>` + Math.round(properties.Panjang__M) + ` Meter</td>
                        </tr>
                        <tr>
                            <th scope="row">Perkerasan</th>
                            <td>` + properties.Tipe_Perke + `</td>
                        </tr>
                        <tr>
                            <th scope="row">Kondisi</th>
                            <td>` + properties.Kondisi_Ja + `</td>
                        </tr>
                    </table>
                    <table class="table table-striped">
                        <tr>
                            <td class="text-center"><a href="#" onclick="gMaps(` + coordinate + `)" style="text-decoration: none"><i class="fas fa-map-marker-alt"></i> Maps </a></td>
                            <td class="text-center"> <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal" style="text-decoration: none"><i class="fas fa-map-marker-alt"></i> Detail</a></td>
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
        if (k == "BAIK") {
            color.color = 'white';
        } else if (k == "SEDANG") {
            color.color = 'yellow';
        } else if (k == "RUSAK RINGAN") {
            color.color = 'orange';
        } else {
            color.color = 'red';
        }
        return color
    }

    var shpBatas = new L.Shapefile("{{ asset('assets/shp/SHP-BATAS-KAB-LN.zip') }}")

    // loop and filter shp berdasarkan kondisi jalan
    var kondisi = ['BAIK', 'SEDANG', 'RUSAK RINGAN', 'RUSAK BERAT']
    kondisi.forEach(function(kondisi) {
        var shpJalan = new L.Shapefile("{{ asset('assets/shp/SHP-JALAN-BUFFER-4.zip') }}", {
            filter: function(f) {
                return f.properties.Kondisi_Ja === kondisi
            },
            style: function(f) {
                return style(f.properties.Kondisi_Ja)
            },
            onEachFeature: function(f, l) {
                // console.log(f.properties)
                var out = [];
                var coordinate = "'" + f.properties.MID_Y + ',' + f.properties.MID_X + "'";
                if (f.properties) {
                    l.bindPopup(popupContent(f.properties,
                        coordinate), {
                        maxWidth: "250",
                        maxHeigth: "auto"
                    });
                }
            }
        })
        layersControl.addOverlay(shpJalan, kondisi);
        shpJalan.addTo(map)
    });

    shpBatas.addTo(map);

    // open googlemaps in new window
    function gMaps(c) {
        // console.log(c)
        url = "https://www.google.com/maps/search/" + c;
        window.open(url, '_blank');
    }
</script>

<script>
    // var sidebar = L.control.sidebar({
    //         container: 'sidebar',
    //         position: 'right',
    //         autopan: true
    //     })
    //     .addTo(map)
    //     .close();

    // add panels dynamically to the sidebar
    // sidebar
    //     .addPanel({
    //         id: 'js-api',
    //         tab: '<i class="fa fa-gear"></i>',
    //         title: 'JS API',
    //         pane: '<p>The Javascript API allows to dynamically create or modify the panel state.<p/><p><button onclick="sidebar.enablePanel(\'mail\')">enable mails panel</button><button onclick="sidebar.disablePanel(\'mail\')">disable mails panel</button></p><p><button onclick="addUser()">add user</button></b>',
    //     })
    //     // add a tab with a click callback, initially disabled
    //     .addPanel({
    //         id: 'mail',
    //         tab: '<i class="fa fa-envelope"></i>',
    //         title: 'Messages',
    //         button: function() {
    //             alert('opened via JS callback')
    //         },
    //         disabled: true,
    //     })

    // // be notified when a panel is opened
    // sidebar.on('content', function(ev) {
    //     switch (ev.id) {
    //         case 'autopan':
    //             sidebar.options.autopan = true;
    //             break;
    //         default:
    //             sidebar.options.autopan = true;
    //     }
    // });

    // var userid = 0

    // function addUser() {
    //     sidebar.addPanel({
    //         id: 'user' + userid++,
    //         tab: '<i class="fa fa-user"></i>',
    //         title: 'User Profile ' + userid,
    //         pane: '<p>user ipsum dolor sit amet</p>',
    //     });
    // }
</script>

</html>
