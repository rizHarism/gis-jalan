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
    $('#penyedia-jasa').on('click', 'td.editor-delete', function(e) {
        e.preventDefault();

        // editor.remove($(this).closest('tr'), {
        //     title: 'Delete record',
        //     message: 'Are you sure you wish to remove this record?',
        //     buttons: 'Delete'
        // });
        alert('delete')
    });
    $('#penyedia-jasa').on('click', 'td.editor-edit', function(e) {
        e.preventDefault();

        // editor.edit($(this).closest('tr'), {
        //     title: 'Edit record',
        //     buttons: 'Update'
        // });
        alert('edit')
    });
    $(document).ready(function() {
        var table = $('#penyedia-jasa').DataTable({
            processing: true,
            ajax: {
                url: '/data/penyediajasa/datatables',
                method: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'direktur'
                },
                {
                    data: 'nib'
                },
                {
                    data: 'npwp'
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
                    render: function(data, type, row) {
                        // var id = data;
                        var deleteButton =
                            "<i class='fas fa-trash-alt delete-data' data-nama='" + data.nama +
                            "' data-id='" + data.id + "'></i>";
                        var button = deleteButton;

                        return button;
                    }
                }
            ],
        });


        //  call modal tambah kelurahan
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/data/penyediajasa/store";
            $('#penyedia-form').attr('action', urlStore);
            $('#penyedia-form').attr('method', 'POST');
            $('#modal-title').html('');
            $('#modal-title').append('TAMBAH DATA PENYEDIA JASA ');
            $('#nama-penyedia').val('');
            $('#nama-direktur').val('');
            $('#alamat').val('');
            $('#nib').val('');
            $('#npwp').val('');
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
                url: '/data/penyediajasa/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    $.each(result.data, (i, data) => {
                        let urlUpdate = '/data/penyediajasa/' + id + '/update';
                        $('#penyedia-form').attr('action', urlUpdate);
                        $('#penyedia-form').attr('method', 'PUT');
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA ' + data.nama);
                        $('#nama-penyedia').val(data.nama);
                        $('#nama-direktur').val(data.direktur);
                        $('#alamat').val(data.alamat);
                        $('#nib').val(data.nib);
                        $('#npwp').val(data.npwp);
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        });

        // modal form on sumbit
        $("#simpan-penyedia").on("click", function() {
            let urlSave = ($("#penyedia-form").attr('action'))
            let method = ($("#penyedia-form").attr('method'))
            var nama = $("#nama-penyedia").val();
            var direktur = $("#nama-direktur").val();
            var alamat = $("#alamat").val();
            var nib = $("#nib").val();
            var npwp = $("#npwp").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                type: method,
                url: urlSave,
                data: JSON.stringify({
                    nama: nama,
                    direktur: direktur,
                    alamat: alamat,
                    nib: nib,
                    npwp: npwp,
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
                title: 'HAPUS DATA ' +
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
                    let urlDelete = "/data/penyediajasa/" + id +
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
