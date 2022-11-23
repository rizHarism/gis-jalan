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
    $('#example').on('click', 'td.editor-delete', function(e) {
        e.preventDefault();

        // editor.remove($(this).closest('tr'), {
        //     title: 'Delete record',
        //     message: 'Are you sure you wish to remove this record?',
        //     buttons: 'Delete'
        // });
        alert('delete')
    });
    $('#example').on('click', 'td.editor-edit', function(e) {
        e.preventDefault();

        // editor.edit($(this).closest('tr'), {
        //     title: 'Edit record',
        //     buttons: 'Update'
        // });
        alert('edit')
    });
    $(document).ready(function() {
        var table = $('#pemeliharaan').DataTable({
            processing: true,
            ajax: {
                url: '/data/pemeliharaan/datatables',
                method: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'pelaksanaan'
                },
                {
                    data: 'penyedia_jasa_id'
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
                    data: null,
                    className: "dt-center editor-edit",
                    defaultContent: '<i class="fa fa-pencil"></i>',
                    orderable: false
                },
                {
                    data: null,
                    className: "dt-center editor-delete",
                    defaultContent: '<i class="fa fa-trash"></i>',
                    orderable: false
                }
            ],
            order: [
                [1, 'asc']
            ],
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
