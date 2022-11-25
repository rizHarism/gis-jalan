<script>
    // $(document).ready(function() {
    //     // $('#dashboard').addClass('active');
    // });
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

{{-- data table --}}

<script>
    // select 2
    $(document).ready(function() {
        $('.select-kecamatan').select2({
            width: '15%',
            theme: 'classic'
        });
        $('.select-kelurahan').select2({
            width: '15%',
            theme: 'classic'
        });
        $('.select-kondisi').select2({
            width: '15%',
            theme: 'classic'
        });
        $('.select-perkerasan').select2({
            width: '15%',
            theme: 'classic'
        });
    });

    // datatables

    var url = '/ruas/kelurahan/datatables';
    var table;

    $(document).ready(function() {
        function loadTable(url) {
            table = $('#ruas-jalan').DataTable({
                processing: true,
                ajax: {
                    url: url,
                    method: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nomor_ruas'
                    },
                    {
                        data: 'nama_ruas'
                    },
                    {
                        data: 'kecamatan.nama'
                    },
                    {
                        data: 'kelurahan.nama'
                    },
                    {
                        data: 'panjang',
                        render: function(data) {
                            return Math.round(data)
                        }
                    },
                    {
                        data: 'perkerasan.perkerasan'
                    },
                    {
                        data: 'kondisi.kondisi'
                    },
                    {
                        data: 'id',
                        width: '10px',
                        orderable: false,
                        render: function(data) {
                            var id = data;
                            var editButton =
                                "<i class='fas fa-eye open-detail' data-id=" + id +
                                "></i>";
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
                            var editButton =
                                "<i class='fas fa-edit edit-data' data-id=" + id +
                                "></i>";
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
                                "<i class='fas fa-trash-alt delete-data' data-id=" + id +
                                "></i>";
                            var button = deleteButton;

                            return button;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });
        }

        loadTable(url);

        // delete data ruas
        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/ruas/kelurahan/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    // alert(result.nama)
                    $.each(result.data, (i, data) => {
                        Swal.fire({
                            title: 'HAPUS RUAS ' +
                                data.nama_ruas,
                            text: ' Apakah Anda yakin ?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus',
                            cancelButtonText: 'Batal'
                        }).then((r) => {
                            if (r.isConfirmed) {
                                table.draw();
                                Swal.fire(
                                    'Terhapus!',
                                    'Ruas ' + data.nama_ruas +
                                    ' Berhasil dihapus',
                                    'success',
                                );
                            }
                        })
                    })
                }
            })
        })

        $(document).on("click", ".edit-data", function() {
            var id = $(this).data('id');
            // window.location.href = '/ruas/kelurahan/' + id + '/edit'
            var editUrl = "{{ route('ruas.kelurahan.edit', ':id') }}";
            editUrl = editUrl.replace(':id', id);
            window.location.href = editUrl
        })

        // select get data and change
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
            $("#list-kelurahan").html("<option value=0>SEMUA KELURAHAN</option>")
            var id = this.value;
            (id == 0) ? $("#list-kelurahan").prop({
                "disabled": true
            }): $("#list-kelurahan").prop({
                "disabled": false
            })
            kelurahan(id);
        });

        // filter data tables
        $("#filter-datatables").on('submit', function(e) {
            e.preventDefault();
            var kecamatan = $('#list-kecamatan').val();
            var kelurahan = $('#list-kelurahan').val();
            var kondisi = $('#list-kondisi').val();
            var perkerasan = $('#list-perkerasan').val();
            (kecamatan == 0 && kelurahan == 0 && kondisi == 0 && perkerasan == 0) ? url =
                '/ruas/kelurahan/datatables':
                url = '/ruas/' + kecamatan + '/' +
                kelurahan + '/' + kondisi + '/' + perkerasan + '/kelurahan';
            console.log(url)
            table.destroy();
            loadTable(url)
        })
    });
</script>

<script>
    // $(document).ready(function() {
    //     // $('#dashboard').addClass('active');
    // });
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
