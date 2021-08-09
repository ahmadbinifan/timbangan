<script type="text/javascript">
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    var table;
    $(document).ready(function() {
        $('#btn-filter').on('click', function() {
            table.page.len(-1).draw();
        });
        table = $('#tableTimbangan').DataTable({

            // "bSort": false,
            // "bInfo": false,
            // "bLengthChange": false,
            // "bPaginate": false,
            "order": [
                [1, "desc"]
            ],
            "scrollY": "400px",
            "scrollX": "100%",
            "scrollCollapse": true,
            "select": true,
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "ajax": {
                "url": "<?= base_url('reject_ticket/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.nm_rls = $('#nm_rls').val();
                    data.tgl_msk = $('#start').val();
                    data.tgl_klr = $('#end').val();
                    data.no_ref = $('#no_ref').val();
                    data.nm_brg = $('#nm_brg').val();
                    data.no_ref2 = $('#no_ref2').val();
                }
            },
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false,
            }, ],
        });
        table.buttons().container()
            .appendTo('#tableTimbangan .col-md-6:eq(0)');

    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('.date_range_filter').val();
            var max = $('.date_range_filter2').val();
            var dateIn = data[1]; // -> rubah angka 4 sesuai posisi tanggal pada tabelmu, dimulai dari angka 0
            if (
                (min == "" || max == "") ||
                (moment(dateIn).isSameOrAfter(min) && moment(dateIn).isSameOrBefore(max))
            ) {
                return true;
            }
            return false;
        }
    );

    $('#btn-filter').click(function() { //button filter event click

        let select = $("#form-filter").find('select[name=no_ref]');
        $.ajax({
            url: "<?= base_url('weighbridge/get_po') ?>",
            method: "post",
            dataType: "json",
            data: {
                tgl_msk: $('#tgl_msk').val(),
                tgl_klr: $('#tgl_klr').val()
            },
            success: function(data) {
                if (data) {
                    let html = `<option value="` + data.no_ref + `"> ` + data.no_ref + `</option>`;
                    $(select).html(html);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        let form = $('#form-filter');
        $('#form-filter')[0].reset();
        form.find('select[name=nm_rls]').val("");
        form.find('select[name=nm_brg]').val("");
        form.find('select[name=no_ref]').trigger("change");
        form.find('select[name=nm_rls]').trigger("change");
        form.find('select[name=nm_brg]').trigger("change");
        table.ajax.reload(); //just reload table
    });

    function listVendor() {
        let select = $("#form-filter").find('select[name=nm_rls]');
        let select2 = $("#form-filter").find('select[name=nm_brg]');
        $.ajax({
            url: "<?= base_url('weighbridge/get_vendor') ?>",
            method: "post",
            dataType: "json",
            data: {
                no_ref: $('#no_ref').val()
            },
            success: function(data) {
                if (data) {
                    let html = `<option value="` + data.nm_rls + `"> ` + data.nm_rls + `</option>`;
                    $(select).html(html);

                    let html2 = `<option value="` + data.nm_brg + `"> ` + data.nm_brg + `</option>`;
                    $(select2).html(html2);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
    }

    function listRef() {
        let select = $("#form-filter").find('input[name=no_ref]');
        $.ajax({
            url: "<?= base_url('weighbridge/get_po') ?>",
            method: "post",
            dataType: "json",
            data: {
                start: $('#tgl_msk').val(),
                end: $('#tgl_klr').val()
            },
            success: function(data) {
                if (data) {
                    let html = `<option value="` + data.no_ref + `"> ` + data.no_ref + `</option>`;
                    $(select).html(html);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
    }

    function reject(id) {
        Swal.fire({
            title: 'Reject this Ticket?',
            text: "This Ticket will be Reject",
            // html: '<label>Please input note</label>' +
            //     '<input id="name" type="text" class="form-control" style="z-index:999"/>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            // let note = $('#name').val();
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('reject_ticket/reject') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Reject Ticket Successfully',
                            text: "This Ticket will be Reject"
                        }).then(function() {
                            table.ajax.reload();
                        });
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }
        })
    }
</script>