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
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // computing column Total of the complete result 
                var Netto = api
                    .column(16)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Update footer by showing the total with the reference of the column index 
                $(api.column(0).footer()).html('Total');
                $(api.column(16).footer()).html(formatNumber(Netto));
            },
            "select": true,
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "ajax": {
                "url": "<?= base_url('weighbridge_priode_out/ajax_list') ?>",
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

            buttons: [
                <?php if ($this->session->userdata('excel') == 1) { ?> {
                        "text": '<span class="fas fa-file-excel">Excel</span>',
                        "className": 'btn btn-success btn-sm',
                        action: function previewData() {
                            // let type = $('#type').val();
                            let no_ref = $('#no_ref').val();
                            // let no_ref2 = $('#no_ref2').val();
                            let start = $('#start').val();
                            let end = $('#end').val();
                            let url = "<?= base_url('report_out/phpExcel_wb_priode/') ?>" + start + "/" + end + "/" + no_ref;
                            window.open(url, "_blank");
                        }
                    },
                <?php } ?>
                <?php if ($this->session->userdata('pdf') == 1) { ?> {
                        "text": '<span class="fas fa-file-pdf">Pdf</span>',
                        "className": 'btn btn-danger btn-sm',
                        action: function previewData() {
                            // let type = $('#type').val();
                            let no_ref = $('#no_ref').val();
                            // let no_ref2 = $('#no_ref2').val();
                            let start = $('#start').val();
                            let end = $('#end').val();
                            let url = "<?= base_url('report_out/printByPriode/') ?>" + start + "/" + end + "/" + no_ref;
                            window.open(url, "_blank");
                        }
                    },
                <?php } ?>
                // {
                //         "extend": 'excel',
                //         "text": '<span class="glyphicon glyphicon-pencil">Excel</span>',
                //         "className": 'btn btn-success btn-sm fas fa-file-excel',
                //         "footer": 'true',
                //         "messageTop": function() {
                //             var a = $('#nm_rls').val();
                //             var b = $('#nm_brg').val();
                //             var c = $('#no_ref').val();
                //             var d = $('#no_ref2').val();
                //             var start = $('#start').val();
                //             var end = $('#end').val();
                //             return 'Period : ' + start + '-' + end + '\n' + ', No PO : ' + c + d + '\n' + ', Vendor :' + a + '\n' + ', Item :' + b;

                //         },
                //         filename: function() {
                //             var d = new Date();
                //             var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                //             var bulan = months[d.getMonth()];
                //             var tanggal = d.getDate();
                //             var jam = d.getHours();
                //             var menit = d.getMinutes();
                //             var tahun = d.getFullYear();
                //             return 'Weighbridge - ' + jam + menit + tanggal + bulan + tahun;
                //         },
                //     },

            ],
            dom: 'Blfrtip',
            lengthMenu: [
                [25, 50, 125, -1],
                ['25 File', '50 File', '125 File', 'Show All']
            ],
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

    // $('.pickdate').change(function() {
    //     table.draw();

    // });

    $('#btn-filter').click(function() { //button filter event click
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

    function listPO() {
        let select = $("#form-filter").find('select[name=no_ref]');
        $.ajax({
            url: "<?= base_url('weighbridge_priode_out/get_po') ?>",
            method: "post",
            dataType: "json",
            data: {
                tgl_msk: $('#start').val(),
                tgl_klr: $('#end').val()
            },
            success: function(data) {
                if (data) {
                    let html = '<option value="">Choose PO No. (Optional)</option>';
                    $.each(data, function(index, value) {
                        html += '"<option value="' + value.no_ref + '">' + value.no_ref + '</option>';
                    });
                    $(select).html(html);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
    }
</script>