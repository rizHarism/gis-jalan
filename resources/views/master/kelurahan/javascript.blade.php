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
    $('#kelurahan').on('click', 'td.editor-delete', function(e) {
        e.preventDefault();

        // editor.remove($(this).closest('tr'), {
        //     title: 'Delete record',
        //     message: 'Are you sure you wish to remove this record?',
        //     buttons: 'Delete'
        // });
        alert('delete')
    });
    $('#kelurahan').on('click', 'td.editor-edit', function(e) {
        e.preventDefault();

        // editor.edit($(this).closest('tr'), {
        //     title: 'Edit record',
        //     buttons: 'Update'
        // });
        alert('edit')
    });
    $(document).ready(function() {
        var table = $('#kelurahan').DataTable({
            processing: true,
            ajax: {
                url: '/data/kelurahan/datatables',
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
                            "<i class='fas fa-edit open-modal' data-id=" + id + " ></i>";
                        var button = editButton;

                        return button;
                    }
                },
                {
                    data: 'id',
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        var id = data;
                        var deleteButton =
                            "<i class='fas fa-trash-alt delete-data' data-id=" + id + "></i>";
                        var button = deleteButton;

                        return button;
                    }
                }
            ]
        });

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
                    // console.log(result.data);
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

        //  call modal tambah kecamatan
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

        // edit form on sumbit
        $("#simpan-kelurahan").on("click", function() {
            let urlSave = ($("#kelurahan-form").attr('action'))
            let method = ($("#kelurahan-form").attr('method'))

            var nama = $("#nama-kelurahan").val();
            var kode = $("#kode-kelurahan").val();
            var kecamatanId = $('#nama-kecamatan').find(":selected").val()

            console.log(nama, kecamatanId, kode)
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
                    // console.log(data);
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
                        console.log(html)
                    }
                }
            });
            $('#modal-form').modal('hide');

        })

        // delete button
        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/data/kelurahan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    $.each(result.data, (i, data) => {
                        Swal.fire({
                            title: 'HAPUS KELURAHAN ' +
                                data.nama,
                            text: ' Apakah Anda yakin ?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                table.draw();
                                Swal.fire(
                                    'Terhapus!',
                                    'Kecamatan ' + data.nama +
                                    ' Berhasil dihapus',
                                    'success',
                                );
                            }
                        })
                    })
                }
            })
        })

        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/data/kelurahan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    $.each(result.data, (i, data) => {
                        Swal.fire({
                            title: 'HAPUS KELURAHAN ' +
                                data.nama,
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
