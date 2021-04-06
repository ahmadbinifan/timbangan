<script>
    $(document).ready(function() {

    });

    function filter(ths) {
        Table.ajax.reload();
    }

    function previewData() {
        // let type = $('#type').val();
        let no_ref = $('#no_ref').val();
        // let start = $('#start').val();
        // let end = $('#end').val();

        let url = "<?= base_url('report_out/printByPO/') ?>" + "/" + no_ref;
        window.open(url, "_blank");

    }

    // function get_ref() {
    //     let select = $("#form-filter").find('select[name=no_ref]');
    //     $.ajax({
    //         url: "<?= base_url('report/get_ref') ?>",
    //         method: "post",
    //         dataType: "json",
    //         data: {
    //             ctatus: ctatus
    //         },
    //         success: function(data) {
    //             let html = '<option value="-">Choose Departement</option>';
    //             $.each(data, function(index, value) {
    //                 html += '"<option value="' + data.no_ref + '">' + data.no_ref + '</option>';
    //             });
    //             $(select).html(html);
    //         },
    //         error: function(e) {
    //             console.log(e);
    //         }
    //     })
    // }

    // function exportExcel() {
    //     let type = $('#type').val();
    //     let budget = $('#budgeted').val();
    //     let project = $('#project').val();
    //     let start = $('#start').val();
    //     let end = $('#end').val();
    //     let url = "<?= base_url('reportcapex/phpExcel/') ?>" + type + "/" + start + "/" + end + "/" + project + "/" + budget;
    //     window.open(url);
    // }
</script>