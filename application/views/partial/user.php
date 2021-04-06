<script>
    $(document).ready(function() {
        userTable = $('#tableUser').DataTable({
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "ajax": {
                "url": "<?= base_url('user/list_user') ?>",
                "type": "POST",
            },
            "columnDefs": [{}, ],
        });
        $('#create').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajax({
                url: '<?= base_url('user/create') ?>',
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'User has been created!',
                            allowOutsideClick: false
                        }).then(function() {
                            $('#modalAdd').modal('hide');
                            userTable.ajax.reload();
                        });
                    } else if (response == "false") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sorry',
                            text: 'Username already exist! Please type another'
                        });
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            })
        });
        $('#edit').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajax({
                url: '<?= base_url('user/update') ?>',
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User has been updated!',
                        allowOutsideClick: false
                    }).then(function() {
                        $('#modalEdit').modal('hide');
                        userTable.ajax.reload();
                    });
                },
                error: function(e) {
                    console.log(e);
                }
            })
        });
    });

    function remove(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to remove this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('user/remove') ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data) {
                            Swal.fire(
                                'Deleted!',
                                'Usser has been deleted.',
                                'success'
                            )
                            userTable.ajax.reload();
                        }
                    }
                })

            }
        })
    }

    function get(id) {
        $.ajax({
            url: "<?= base_url('user/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {
                let form = $('#edit');
                form.find('input[name=id_user]').val(data.id_user);
                form.find('input[name=fullname]').val(data.fullname);
                form.find('input[name=email]').val(data.email);
                form.find('input[name=nik]').val(data.nik);
            }
        });
    }

    function clearAdd() {
        let form = $('#create');
        form.find('input[name=fullname]').val(null);
        form.find('input[name=username').val(null);
        form.find('input[name=email]').val(null);
        form.find('input[name=nik]').val(null);

    }
</script>