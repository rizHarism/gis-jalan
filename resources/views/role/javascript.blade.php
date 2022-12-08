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
        var table = $('#role-table').DataTable({
            processing: true,
            ajax: {
                url: '/admin/role/datatables',
                method: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    "width": "5%"
                },
                {
                    data: 'name'
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
                            "<i class='fas fa-trash-alt delete-data' data-nama='" + data.name +
                            "' data-id='" + data.id + "'></i>";
                        var button = deleteButton;

                        return button;
                    }
                }
            ]
        });


        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // add role
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/admin/role/store";
            $('#role-form').attr('action', urlStore);
            $('#role-form').attr('method', 'POST');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/admin/role/create',
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#role-name').val('');
                    $('#row-role').html('');
                    let num = 1;
                    let cbNum = 1;
                    $.each(result.permissionsFormatted, (i, data) => {
                        $('#row-role').append(
                            `<div class="col-sm-4 " style="margin-bottom: 20px;">
                            <span class="h5">` + i.toUpperCase() + `</span><br />
                            <div class="h5> mt-2" id="role-title-` + num + `"></div>
                            </div>`)
                        $.each(data, (x, dt) => {
                            $('#role-title-' + num).append(
                                `<input name="permissions" class="" type="checkbox" id="checkbox-` +
                                cbNum + `" value="` + dt.value + `" >
                            <label for="checkbox-` + cbNum + `">` + dt.name + `</label>
                            <br>`);

                            cbNum++
                        })
                        num++;
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            })
        })


        //edit role
        $(document).on("click", ".edit-data", function() {
            var id = $(this).data('id');
            let urlUpdate = "/admin/role/" + id + "/update";
            $('#role-form').attr('action', urlUpdate);
            $('#role-form').attr('method', 'PUT');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/admin/role/' + id + '/edit',
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#role-name').val(result.role.name);
                    $('#row-role').html('');
                    let num = 1;
                    let cbNum = 1;
                    let cbVal = Object.values(result.rolePermissions);
                    var centang = 'checked';
                    $.each(result.permissionsFormatted, (i, data) => {
                        $('#row-role').append(
                            `<div class="col-sm-4 " style="margin-bottom: 20px;">
                            <span class="h5">` + i.toUpperCase() + `</span><br />
                            <div class="h5> mt-2" id="role-title-` + num + `"></div>
                            </div>`)
                        $.each(data, (x, dt) => {
                            (cbVal.includes(dt.value)) ? centang =
                                'checked': centang = '';
                            $('#role-title-' + num).append(
                                `<input name="permissions" class="" type="checkbox" id="checkbox-` +
                                cbNum + `" value="` + dt.value + `" ` +
                                centang + `>
                            <label for="checkbox-` + cbNum + `">` + dt.name + `</label>
                            <br>`);

                            cbNum++
                        })
                        num++;
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        })

        $('#role-form').on('submit', (e) => {
            e.preventDefault();
            let permission = [];
            let roleName = $('#role-name').val();
            $('input[name="permissions"]:checked').each(function() {
                permission.push(this.value);
            });
            let urlSave = ($("#role-form").attr('action'))
            let method = ($("#role-form").attr('method'))
            let formData = new FormData;
            formData.append('role_name', roleName);
            formData.append('permission', permission);
            if (method == 'PUT') {
                formData.append('_method', 'PUT')
            }

            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    // 'Content-Type': 'application/json',
                },
                type: "POST",
                url: urlSave,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#modal-form').modal('hide');
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
                            "<ul style='justify-content: space-between;'>";
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
            return false;

        });

        // delete role
        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            Swal.fire({
                title: 'HAPUS ROLE ' +
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
                    let urlDelete = "/admin/role/" + id +
                        "/delete";
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
                            Swal.fire(
                                'Berhasil',
                                data
                                .message,
                                'success',
                            );
                            table.ajax.reload();
                        },
                        error: (xhr, ajaxOptions,
                            thrownError) => {
                            console.log(xhr.responseJSON
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

        // end document ready
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
