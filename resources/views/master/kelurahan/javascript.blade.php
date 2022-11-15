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
                            "<i class='fas fa-trash-alt delete-data' data-id=" + id + "'></i>";
                        var button = deleteButton;

                        return button;
                    }
                }
            ]
        });





        // {{-- call modal edit dynamic --}}

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
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA KELURAHAN');
                        $('#nama-kelurahan').html('');
                        $('#nama-kelurahan').val(data.nama);
                        $('#kode-kelurahan').html('');
                        $('#kode-kelurahan').val(data.kode_kelurahan);
                        var idKec = data.kecamatan.id
                        // call ajax for kecamatan dropdown
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            url: '/get/kecamatan/',
                            dataType: "json",
                            async: false,
                            success: function(result) {
                                $('#nama-kecamatan').html('');
                                console.log(result.data);
                                $.each(result.data, (i, data) => {
                                    $('#nama-kecamatan').append(
                                        $(
                                            '<option>', {
                                                value: data
                                                    .id,
                                                text: data
                                                    .nama
                                            }));

                                })

                            }
                        });

                        $('option[value=' + idKec + ']').attr(
                            'selected', 'selected')
                    })
                    // Display Modal
                    $('#modal-edit').modal('show');
                }
            });
        });

        // edit form on sumbit
        $("#simpan-kelurahan").on("click", function() {
            $('#modal-edit').modal('hide');
            Swal.fire(
                'Data Tersimpan',
                'Berhasil',
                'success'
            )

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
    });
</script>
