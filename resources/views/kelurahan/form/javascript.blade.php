<script>
    // $(document).ready(function() {
    //     // $('#dashboard').addClass('active');
    // });
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

{{-- leaflet --}}
<script>
    var map = L.map('map').setView([-8.130866, 112.220006], 12);
    $("#map").height($(".map").height());
    map.invalidateSize()
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

    // call tool geoman
    function create() {
        map.pm.addControls({
            position: 'topleft',
            drawMarker: false,
            drawCircleMarker: false,
            drawRectangle: false,
            drawPolygon: false,
            drawPolyline: true,
            drawCircle: false,
            drawText: false,
            editMode: false,
            dragMode: false,
            cutPolygon: false,
            rotateMode: false
        });
    }

    function edit() {
        map.pm.addControls({
            position: 'topleft',
            drawMarker: false,
            drawCircleMarker: false,
            drawRectangle: false,
            drawPolygon: false,
            drawPolyline: false,
            drawCircle: false,
            drawText: false,
            editMode: true,
            dragMode: false,
            cutPolygon: false,
            rotateMode: false
        });
    }

    var g = $('#geometry').val();
    console.log(g.length)
    if (g) {
        g = JSON.parse($('#geometry').val());
        var geom = new L.geoJson(g).addTo(map);
        map.fitBounds(geom.getBounds());
        edit()
    } else {
        create()
    }

    map.on("pm:remove", (e) => {
        $('#startx').val('')
        $('#starty').val('')
        $('#midx').val('')
        $('#midy').val('')
        $('#endx').val('')
        $('#endy').val('')
        create()
    })

    map.on("pm:create", (e) => {
        function explodeGeo(e) {
            let layer = e.layer;
            let len = layer._latlngs.length - 1
            console.log(layer._latlngs[0].lat)
            console.log(layer.getCenter().lat)
            console.log(layer._latlngs[len].lat)
            // let startX = e.layer._latlngs[0].lng
            // let startY = e.layer._latlngs[0].lat
            // let endX = e.layer._latlngs[len].lng
            // let endY = e.layer._latlngs[len].lat

            $('#startx').val(layer._latlngs[0].lng)
            $('#starty').val(layer._latlngs[0].lat)
            $('#midx').val(layer.getCenter().lng)
            $('#midy').val(layer.getCenter().lat)
            $('#endx').val(layer._latlngs[len].lng)
            $('#endy').val(layer._latlngs[len].lat)
        }
        explodeGeo(e)
        edit()
        e.layer.on("pm:edit", (e) => {
            explodeGeo(e)
        })
    })
</script>


{{-- get kelurahan when select kecamatan --}}
<script>
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
                $("#list-kelurahan").append(listItems);
            }
        });
    }

    $('#list-kecamatan').on('change', function() {
        $("#list-kelurahan").html("<option value=0>-- Pilih Kelurahan --</option>")
        var id = this.value;
        (id == 0) ? $("#list-kelurahan").prop({
            "disabled": true
        }): $("#list-kelurahan").prop({
            "disabled": false
        })
        kelurahan(id);
    });
</script>

<script>
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
