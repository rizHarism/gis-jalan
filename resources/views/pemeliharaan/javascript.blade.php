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
        $('.select-penyedia').select2({
            width: '100%',
            theme: 'classic'
        });
        $('.select-no-ruas').select2({
            width: '100%',
            theme: 'classic'
        });
    });
    $(document).ready(function() {
        var url = '/data/pemeliharaan/datatables';
        var table;

        function loadTable(url) {
            table = $('#pemeliharaan').DataTable({
                processing: true,
                ajax: {
                    url: url,
                    method: 'GET'
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'pelaksanaan'
                    },
                    {
                        data: 'penyedia.nama'
                    },
                    {
                        data: 'biaya'
                    },
                    {
                        data: 'ruas_id',
                        render: function(data) {
                            return JSON.parse(data.replace(/&quot;/g, '"'));
                        }
                    },
                    {
                        data: 'keterangan'
                    },
                    {
                        data: 'id',
                        width: '10px',
                        orderable: false,
                        render: function(data) {
                            var id = data;
                            var editButton =
                                "<i class='fas fa-edit open-modal' data-id=" + id + " ></i>";
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
                ],

            });
        };

        loadTable(url)

        //add modal list item penyediajasa
        function getPenyedia() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/get/penyediajasa/',
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#penyedia').html('');
                    // console.log(result.data);
                    $.each(result.data, (i, data) => {
                        $('#penyedia').append(
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
        function penyedia() {
            $.ajax({
                type: "GET",
                url: '/get/penyediajasa',
                dataType: "json",
                success: function(p) {
                    var penyedia = p.data,
                        listItems = ""
                    $.each(penyedia, (i, property) => {
                        listItems += "<option value='" + property.id + "'>" + property
                            .nama +
                            "</option>"
                    })
                    $("#list-penyedia").append(listItems);
                }
            });
        }
        penyedia();

        // filter kelurahan berdasar kecamatan
        $("#filter-datatables").on('submit', function(e) {
            e.preventDefault();
            var penyedia = $('#list-penyedia').val();
            (penyedia == 0) ? url = '/data/pemeliharaan/datatables': url = '/data/pemeliharaan/' +
                penyedia +
                '/filter';
            table.destroy();
            loadTable(url)
        })

        // call ruas for select2 form add/edit
        function ruasId() {
            $.ajax({
                type: "GET",
                url: '/get/ruas/select',
                dataType: "json",
                success: function(ruas) {
                    var listItems = ""
                    $.each(ruas.data, (i, data) => {
                        listItems += "<option value='" + data.id + "'>" + data.nama +
                            " Ruas No: " + data
                            .nomor_ruas +
                            "</option>"
                    })
                    $("#no-ruas").append(listItems);
                }
            });
        }
        ruasId();

        // date time picker
        $("#pelaksanaan").datetimepicker({
            timepicker: false,
            format: 'd/m/Y'
        });

        //  call modal tambah pemeliharaan
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/data/pemeliharaan/store";
            $('#pemeliharaan-form').attr('action', urlStore);
            $('#pemeliharaan-form').attr('method', 'POST');
            $('#modal-title').html('');
            $('#modal-title').append('TAMBAH DATA PEMELIHARAAN ');
            $('#pelaksanaan').val('');
            $('#penyedia').val('');
            $('#anggaran').val('');
            $('#no-ruas').html('');
            $('#keterangan').val('');
            getPenyedia()
            ruasId();
            $('#modal-form').modal('show');

        })

        // call modal edit pemeliharaan
        $(document).on("click", ".open-modal", function() {
            var id = $(this).data('id');
            console.log(id)
            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/data/pemeliharaan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    $.each(result.data, (i, data) => {
                        let tgl = moment(data.pelaksanaan).format('DD/MM/YYYY')
                        let urlUpdate = '/data/pemeliharaan/' + data.id + '/update';

                        let ruass = JSON.parse(data.ruas_id)
                        $('#no-ruas').val(ruass).trigger("change")
                        $('#pemeliharaan-form').attr('action', urlUpdate);
                        $('#pemeliharaan-form').attr('method', 'POST');
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA PEMELIHARAAN');
                        $('#pelaksanaan').val(tgl);
                        $('#anggaran').val(data.biaya);
                        $('#keterangan').val(data.keterangan);
                        // ruasId()

                        getPenyedia()
                        var idPy = data.penyedia.id
                        $('#penyedia option[value=' + idPy + ']').attr(
                            'selected', 'selected')
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        });

        $("#simpan-pemeliharaan").on("click", function() {
            let urlSave = ($("#pemeliharaan-form").attr('action'))
            let method = ($("#pemeliharaan-form").attr('method'))

            var pelaksanaan = $("#pelaksanaan").val();
            var penyediaId = $('#penyedia').find(":selected").val()
            var anggaran = $("#anggaran").val();
            var ruas = JSON.stringify($("#no-ruas").val());
            var keterangan = $("#keterangan").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                type: method,
                url: urlSave,
                data: JSON.stringify({
                    pelaksanaan: pelaksanaan,
                    penyedia: penyediaId,
                    anggaran: anggaran,
                    ruas: ruas,
                    keterangan: keterangan,
                }),
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
                        table.ajax.reload();
                    });
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr, ajaxOptions, thrownError)
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
                        console.log(html)
                    }
                }
            });
            $('#modal-form').modal('hide');

        })

        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            Swal.fire({
                title: 'HAPUS DATA PEMELIHARAAN',
                text: ' Apakah Anda yakin ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let urlDelete = "/data/pemeliharaan/" + id +
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
