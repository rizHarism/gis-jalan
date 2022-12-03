<script>
    var urlw = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == urlw;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == urlw;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<script>
    $(document).ready(function() {
        $('.select-kecamatan').select2({
            width: '100%',
            theme: 'classic'
        });
    });
    var url = '/data/kelurahan/datatables';
    var table;
    $(document).ready(function() {
        function loadTable(url) {
            table = $('#kelurahan').DataTable({
                processing: true,
                ajax: {
                    url: url,
                    method: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'kecamatan.nama'
                    },
                    {
                        data: 'kecamatan.kode_kecamatan'
                    },
                    {
                        data: 'kode_kelurahan'
                    },
                    {
                        data: 'id',
                        width: '10px',
                        orderable: false,
                        render: function(data) {
                            var id = data;
                            var editButton =
                                "<i class='fa fa-pencil open-modal' data-id=" + id + " ></i>";
                            var button = editButton;

                            return button;
                        }
                    },
                    {
                        data: null,
                        width: '10px',
                        orderable: false,
                        render: function(data) {
                            // var id = data;
                            var deleteButton =
                                "<i class='fas fa-trash-alt delete-data' data-nama='" +
                                data.nama + "' data-id='" + data.id +
                                "''></i>";
                            var button = deleteButton;

                            return button;
                        }
                    }
                ]
            })
        }

        loadTable(url)

        // call data kecamatan for dropdown select

        function getKecamatan() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/get/kecamatan/',
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#nama-kecamatan').html('');
                    $.each(result.data, (i, data) => {
                        $('#nama-kecamatan').append(
                            $('<option>', {
                                value: data.id,
                                text: data.nama
                            })
                        );

                    })

                }
            });
        }

        // select2 filter add list item
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
                    $("#list-kecamatan").append(listItems);
                }
            });
        }
        kecamatan();

        // filter kelurahan berdasar kecamatan
        $("#filter-datatables").on('submit', function(e) {
            e.preventDefault();
            var kecamatan = $('#list-kecamatan').val();
            (kecamatan == 0) ? url = '/data/kelurahan/datatables': url = '/data/' + kecamatan +
                '/filter';

            table.destroy();
            loadTable(url)
        })

        //  call modal tambah kelurahan
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/data/kelurahan/store";
            $('#kelurahan-form').attr('action', urlStore);
            $('#kelurahan-form').attr('method', 'POST');
            $('#modal-title').html('');
            $('#modal-title').append('TAMBAH DATA KELURAHAN ');
            $('#nama-kelurahan').val('');
            $('#kode-kelurahan').val('');
            getKecamatan()
            $('#modal-form').modal('show');

        })

        // call modal edit kelurahan

        $(document).on("click", ".open-modal", function() {
            var id = $(this).data('id');
            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/data/kelurahan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    $.each(result.data, (i, data) => {
                        let urlUpdate = '/data/kelurahan/' + id + '/update';
                        $('#kelurahan-form').attr('action', urlUpdate);
                        $('#kelurahan-form').attr('method', 'PUT');
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA KELURAHAN');
                        $('#nama-kelurahan').html('');
                        $('#nama-kelurahan').val(data.nama);
                        $('#kode-kelurahan').html('');
                        $('#kode-kelurahan').val(data.kode_kelurahan);
                        // call ajax for kecamatan dropdown
                        getKecamatan()
                        var idKec = data.kecamatan.id
                        $('option[value=' + idKec + ']').attr(
                            'selected', 'selected')
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        });

        // modal form on sumbit
        $("#simpan-kelurahan").on("click", function() {
            let urlSave = ($("#kelurahan-form").attr('action'))
            let method = ($("#kelurahan-form").attr('method'))

            var nama = $("#nama-kelurahan").val();
            var kode = $("#kode-kelurahan").val();
            var kecamatanId = $('#nama-kecamatan').find(":selected").val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                type: method,
                url: urlSave,
                data: JSON.stringify({
                    nama: nama,
                    kecamatan_id: kecamatanId,
                    kode: kode,
                }),
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    swal.fire({
                        title: 'Berhasil',
                        text: data,
                        icon: 'success',
                    }).then(function() {
                        table.ajax.reload();
                    });
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    if (xhr.responseJSON.hasOwnProperty('errors')) {
                        var html =
                            "<ul style=justify-content: space-between;'>";
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
            $('#modal-form').modal('hide');

        })


        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            Swal.fire({
                title: 'HAPUS KELURAHAN ' +
                    nama,
                text: ' Apakah Anda yakin ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let urlDelete = "/data/kelurahan/" + id +
                        "/destroy";
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "DELETE",
                        url: urlDelete,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            if (data.value == 0) {
                                Swal.fire(
                                    'Error',
                                    data
                                    .message,
                                    'warning',
                                )
                            } else if (data.value ==
                                1) {
                                Swal.fire(
                                    'Berhasil',
                                    data
                                    .message,
                                    'success',
                                )
                            }
                            table.ajax.reload();
                        },
                        error: (xhr, ajaxOptions,
                            thrownError) => {
                            alert(xhr.responseJSON
                                .message);
                            if (xhr.responseJSON
                                .hasOwnProperty(
                                    'errors')) {
                                for (item in xhr
                                    .responseJSON
                                    .errors) {
                                    if (xhr
                                        .responseJSON
                                        .errors[
                                            item]
                                        .length) {
                                        for (var i =
                                                0; i <
                                            xhr
                                            .responseJSON
                                            .errors[
                                                item
                                            ]
                                            .length; i++
                                        ) {
                                            alert(xhr
                                                .responseJSON
                                                .errors[
                                                    item
                                                ]
                                                [
                                                    i
                                                ]
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            })
        })

    });
</script>

<script>
    var urlw = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == urlw;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == urlw;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
