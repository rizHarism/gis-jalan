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



        // {{-- call modal edit dynamic and delete --}}

        $(document).on("click", ".open-modal", function() {
            var id = $(this).data('id');
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
                    console.log(result.data);
                    $.each(result.data, (i, data) => {
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA KECAMATAN');
                        $('#nama-kecamatan').html('');
                        $('#nama-kecamatan').val(data.nama);
                        $('#kode-kecamatan').html('');
                        $('#kode-kecamatan').val(data.kode_kecamatan);
                    })

                    // Display Modal
                    $('#modal-edit').modal('show');
                }
            });
        });

        // edit form on sumbit
        $("#simpan-kecamatan").on("click", function() {
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
                url: '/data/kecamatan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    $.each(result.data, (i, data) => {
                        Swal.fire({
                            title: 'HAPUS KECAMATAN ' +
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
