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
        var table = $('#kecamatan').DataTable({
            processing: true,
            ajax: {
                url: '/data/kecamatan/datatables',
                method: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'kode_kecamatan'
                },
                {
                    data: 'id',
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        var id = data;
                        var editButton =
                            "<i class='fa fa-pencil edit-data' data-id=" + id + " ></i>";
                        var button = editButton;

                        return button;
                    }
                },
                {
                    data: null,
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        var deleteButton =
                            "<i class='fas fa-trash-alt delete-data' data-nama='" + data.nama +
                            "' data-id='" + data.id + "'></i>";
                        var button = deleteButton;

                        return button;
                    }
                }
            ]
        });


        //  call modal tambah kecamatan
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/data/kecamatan/store";
            $('#kecamatan-form').attr('action', urlStore);
            $('#kecamatan-form').attr('method', 'POST');
            $('#modal-title').html('');
            $('#modal-title').append('TAMBAH DATA KECAMATAN ');
            $('#nama-kecamatan').val('');
            $('#kode-kecamatan').val('');
            $('#modal-form').modal('show');
        })

        // call modal edit kecamatan

        $(document).on("click", ".edit-data", function() {
            var id = $(this).data('id');
            let urlUpdate = '/data/kecamatan/' + id + '/update';
            $('#kecamatan-form').attr('action', urlUpdate);
            $('#kecamatan-form').attr('method', 'PUT');
            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/data/kecamatan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    // Add response in Modal body
                    // console.log(result);
                    $.each(result.data, (i, data) => {
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA KECAMATAN ' + data
                            .nama);
                        $('#nama-kecamatan').val(data.nama);
                        $('#kode-kecamatan').val(data.kode_kecamatan);
                    })

                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        });

        // edit form on sumbit
        $("#kecamatan-form").on("submit", function(e) {
            e.preventDefault()
            let urlSave = ($("#kecamatan-form").attr('action'))
            let method = ($("#kecamatan-form").attr('method'))

            var nama = ($("#nama-kecamatan").val());
            var kode = $("#kode-kecamatan").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                type: method,
                url: urlSave,
                data: JSON.stringify({
                    nama: nama,
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
            var nama = $(this).data('nama');
            Swal.fire({
                title: 'HAPUS KECAMATAN ' +
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
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "DELETE",
                        url: '/data/kecamatan/' + id +
                            '/destroy',
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
