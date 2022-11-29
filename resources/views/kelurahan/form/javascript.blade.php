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
            $('#geometry').val(JSON.stringify(layer.toGeoJSON().geometry))
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
{{-- image input --}}
<script>
    $("#image-input").change(function() {
        var ext = $('#image-input').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
            swal.fire({
                title: 'Error',
                html: 'Foto Profile harus berupa Gambar',
                icon: 'warning',
            })
            $("#image-input").val("")
        } else {
            changeImage(this);
        }
    });

    function changeImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#foto-ruas').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
{{-- post data --}}
<script>
    $("#ruas-form").on("submit", function(e) {
        e.preventDefault();
        let urlSave = ($("#ruas-form").attr('action'))
        let method = ($("#ruas-form").attr('method'))

        var formData = new FormData;
        var putMethod = '{{ isset($edit) }}'

        formData.append('nomor', $("#nomorRuas").val());
        formData.append('nama', $("#namaRuas").val());
        formData.append('pangkal', $("#pangkalRuas").val());
        formData.append('ujung', $("#ujungRuas").val());
        formData.append('lingkungan', $("#lingkungan").val());
        formData.append('kecamatan', $("#list-kecamatan").find(":selected").val());
        formData.append('kelurahan', $("#list-kelurahan").find(":selected").val());
        formData.append('panjang', $("#panjang").val());
        formData.append('lebar', $("#lebar").val());
        formData.append('bahuKanan', $("#bahuKanan").val());
        formData.append('bahuKiri', $("#bahuKiri").val());
        formData.append('kondisi', $("#kondisi").find(":selected").val());
        formData.append('perkerasan', $("#perkerasan").find(":selected").val());
        formData.append('utilitas', $("#utilitas").val());
        formData.append('geometry', $("#geometry").val());
        formData.append('startx', $("#startx").val());
        formData.append('starty', $("#starty").val());
        formData.append('midx', $("#midx").val());
        formData.append('midy', $("#midy").val());
        formData.append('endx', $("#endx").val());
        formData.append('endy', $("#endy").val());
        formData.append('image', $('input[type=file]')[0].files[0]);

        if (putMethod) {
            formData.append('_method', 'PUT')
        }

        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                // 'Content-Type': 'application/json',
            },
            type: "POST",
            url: urlSave,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);
                swal.fire({
                    title: 'Berhasil',
                    text: data,
                    icon: 'success',
                }).then(function() {
                    window.location = document.referrer;
                });
            },
            error: (xhr, ajaxOptions, thrownError) => {
                if (xhr.responseJSON.hasOwnProperty('errors')) {
                    var html =
                        "<ul style='justify-content: space-between;'>";
                    for (item in xhr.responseJSON.errors) {
                        if (xhr.responseJSON.errors[item].length) {
                            for (var i = 0; i < xhr.responseJSON.errors[item]
                                .length; i++) {
                                html += "<li class='dropdown-item'>" +
                                    "<i class='fas fa-times' style='color: red;'></i> &nbsp&nbsp&nbsp&nbsp" +
                                    xhr
                                    .responseJSON
                                    .errors[item][i] +
                                    "</li>"
                            }
                        }
                    }
                    html += '</ul>';
                    swal.fire({
                        title: 'Error',
                        html: html,
                        icon: 'warning',
                    });
                }
            }
        });
        return false;
    })
</script>
<script>
    var urlw = window.location.protocol + '//' + window.location.host + '/ruas/kelurahan';

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == urlw;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == urlw;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
