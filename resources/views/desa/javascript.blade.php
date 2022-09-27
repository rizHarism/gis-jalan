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
        var table = $('#example').DataTable({
            processing: true,
            ajax: "{{ asset('assets/shp/jalan-buffer.geojson') }}",
            columns: [{
                    "data": null
                },
                {
                    data: 'properties.Nama_Ruas'
                },
                {
                    data: 'properties.Kelurahan'
                },
                {
                    data: 'properties.Panjang__M',
                    render: function(data) {
                        return Math.round(data);
                    }
                },
                {
                    data: 'properties.Tipe_Perke'
                },
                {
                    data: 'properties.Kondisi_Ja'
                }
            ]
        });


        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
                console.log(cell)
            });
        }).draw();
    });
</script>
