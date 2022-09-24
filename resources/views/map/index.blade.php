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

    {{-- leaflet css and js --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    {{-- fontawesome css --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- shp to geojson --}}
    <script src="{{ asset('assets/shp/leaflet.shpfile.js') }}"></script>
    <script src="{{ asset('assets/shp/shp.js') }}"></script>
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
    @include('map.layouts.navbar')
    @include('map.layouts.sidebar')
    <div id="map"></div>
    {{ 'aplikasi gis perkim' }}
</body>

<script>
    var map = L.map('map').setView([-8.100000, 112.150002], 13);

    var tiles = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        }).addTo(map);

    // var base = "";??
    var shpBatas = new L.Shapefile("{{ asset('assets/shp/SHP-BATAS-KAB-LN.zip') }}")
    var shpJalan = new L.Shapefile("{{ asset('assets/shp/SHP-RUAS-JALAN.zip') }}", {
        style: function(f) {
            var style = {
                color: 'red'
            }
            return style
        },
        onEachFeature: function(f, l) {
            var out = [];
            if (f.properties) {
                console.log(f.properties)
                out.push(f.properties.Nama_Ruas);
                // out.push(f.properties.NAMOBJ);
                l.bindPopup(out.join("<br />"));
            }
        }
    })
    shpBatas.addTo(map);
    shpJalan.addTo(map);
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
    sidebar
        .addPanel({
            id: 'js-api',
            tab: '<i class="fa fa-gear"></i>',
            title: 'JS API',
            pane: '<p>The Javascript API allows to dynamically create or modify the panel state.<p/><p><button onclick="sidebar.enablePanel(\'mail\')">enable mails panel</button><button onclick="sidebar.disablePanel(\'mail\')">disable mails panel</button></p><p><button onclick="addUser()">add user</button></b>',
        })
        // add a tab with a click callback, initially disabled
        .addPanel({
            id: 'mail',
            tab: '<i class="fa fa-envelope"></i>',
            title: 'Messages',
            button: function() {
                alert('opened via JS callback')
            },
            disabled: true,
        })

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

</html>
