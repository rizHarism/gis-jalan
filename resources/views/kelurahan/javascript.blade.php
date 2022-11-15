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

{{-- data table --}}

<script>
    // select 2
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option',
            width: '30%',
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
                                "<i class='fas fa-edit open-modal' data-id=" + id +
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

        $(document).on("click", ".delete-data", function() {
            alert('delete');
            url = '/ruas/2/1/kelurahan/';
            table.destroy();
            loadTable(url);
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
            (kecamatan == 0) ? url = '/ruas/kelurahan/datatables': url = '/ruas/' + kecamatan + '/' +
                kelurahan +
                '/kelurahan/';
            table.destroy();
            loadTable(url)
            // const nama_kec = $('#list-kecamatan').find("option:selected").text();
            // const nama_kel = $('#list-kelurahan').find("option:selected").text();
            // $('#title-dashboard').html("");
            // if (kecamatan == 0) {
            //     $('#title-dashboard').append("DATA " + nama_kec + " / " + nama_kel)
            // } else if (kelurahan == 0) {
            //     $('#title-dashboard').append("DATA KECAMATAN " + nama_kec + " / " + nama_kel);
            // } else {
            //     $('#title-dashboard').append("DATA KECAMATAN " + nama_kec + " / KELURAHAN " + nama_kel);
            // }

        })
    });
</script>
