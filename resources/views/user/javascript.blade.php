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
        var table = $('#user-table').DataTable({
            processing: true,
            ajax: {
                url: '/admin/user/datatables',
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
                    data: 'username'
                },
                {
                    data: 'roles[0].name'
                },
                {
                    data: 'last_login_at'
                },
                {
                    data: 'last_login_ip'
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

        // call data ROLE for dropdown select

        function getRole() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/admin/get/role/',
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#role-user').html('');
                    $.each(result.data, (i, data) => {
                        $('#role-user').append(
                            $('<option>', {
                                value: data.id,
                                text: data.name
                            })
                        );

                    })

                }
            });
        }

        //  call modal tambah user
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/admin/user/store";
            $('#user-form').attr('action', urlStore);
            $('#user-form').attr('method', 'POST');
            $('#foto-user').attr('src', "{{ asset('assets/image/avatar/avatar-default.png') }}");
            $('#modal-title').html('');
            $('#modal-title').append('TAMBAH DATA PENGGUNA ');
            $('#password').html('');
            $('#password').html('KATA SANDI');
            $('#nama-asli').val('');
            $('#nama-user').val('');
            $('#password').val('');
            $('#password2').val('');
            getRole()
            $('#modal-form').modal('show');

        })

        $(document).on("click", ".edit-data", function() {
            var id = $(this).data('id');
            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/admin/user/' + id + '/show',
                dataType: "json",
                async: false,
                success: function(result) {
                    getRole()
                    $.each(result, (i, data) => {
                        let urlUpdate = '/admin/user/' + data.id + '/update';

                        $('#foto-user').attr('src',
                            "{{ asset('assets/image/avatar') }}" + '/' + data
                            .avatar);
                        $('#user-form').attr('action', urlUpdate);
                        $('#user-form').attr('method', 'PUT');
                        $('#modal-title').html('');
                        $('#modal-title').append('EDIT DATA PENGGUNA ');
                        $('#password').html('');
                        $('#password').html('KATA SANDI BARU');
                        $('#nama-asli').val(data.name);
                        $('#nama-user').val(data.username);
                        var idUser = data.id
                        $('option[value=' + idUser + ']').attr(
                            'selected', 'selected')
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        });

        // ubah tampilan foto
        $("#image-user").change(function() {
            var ext = $('#image-user').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                swal.fire({
                    title: 'Error',
                    html: 'Foto profil pengguna harus file Gambar',
                    icon: 'warning',
                })
                $("#image-user").val("")
            } else {
                changeImage(this);
            }
        });

        function changeImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#foto-user').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#user-form").on("submit", function(e) {
            e.preventDefault();
            let urlSave = ($("#user-form").attr('action'))
            let method = ($("#user-form").attr('method'))

            var formData = new FormData;

            formData.append('nama_lengkap', $("#nama-asli").val());
            formData.append('username', $("#nama-user").val());
            formData.append('role', $("#role-user").find(":selected").val());
            formData.append('password', $("#password-1").val());
            formData.append('password2', $("#password-2").val());
            formData.append('image', $('input[type=file]')[0].files[0]);

            if (method == 'PUT') {
                formData.append('_method', 'PUT')
            }
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ': ' + pair[1]);
            // }
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
        })


        // delete user
        $(document).on("click", ".delete-data", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            Swal.fire({
                title: 'HAPUS USER ' +
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
                    let urlDelete = "/admin/user/" + id +
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
        //end of document ready
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
