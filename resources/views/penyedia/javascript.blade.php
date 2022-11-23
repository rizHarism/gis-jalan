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
