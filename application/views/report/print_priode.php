<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @page {

            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 2cm;
            margin-right: 3cm;
        }

        #footer {
            position: fixed;
            right: 0px;
            bottom: 10px;
            text-align: center;

        }

        #footer .page:after {
            content: counter(page, decimal);
        }

        p {
            font-size: 10px;
        }

        p.custom {
            font-size: 13px;
        }

        p.form {
            font-size: 8px;
            text-align: start;
            float: right;
        }

        img {
            float: left;
        }

        table,
        th {
            border: 1px solid black;
            font-family: sans-serif;
            font-size: 9px;
        }

        td {
            border: 1px solid black;
            font-size: 8px;
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: sans-serif;
            font-size: 10px;
            text-align: center;
            font-weight: bold;
            /* text-transform: uppercase; */
            page-break-inside: auto
        }

        div.bold {
            font-size: 10px;
            tab-size: 8;
        }

        .border-top {
            border-top-style: solid;
            border-bottom-style: solid;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;

        }

        table.noborder {
            width: 100%;
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

        #box1 {
            width: 80px;
            font-size: 8px;
            font-family: 'Times New Roman', Times, serif;
            height: 40px;
            background: white;
            border: solid 1px black;
            float: right;
        }

        hr {
            border-top: 0.5px solid;
        }

        .tab {
            display: inline-block;
            margin-left: 40px;
        }
    </style>


    <title>Weighbridge Report</title>



</head>

<body>
    <img src="<?= $logo ?>" style="width:80px;height:70px;margin-right:15px;">
    <div class="">
        <p style="font-size: 13px;"><b>PT. DOMAS AGROINTI PRIMA <input type="checkbox" style="  line-height: 0.7;" checked><br>
                PT. DOMAS SAWIT INTI PERDANA </b>
            <br>
            <i style="font-size: 10px;">JL. Access Road Inalum Kuala Tanjung Km. 15<br>
                Batu Bara - Sumatera Utara, Indonesia <br>
                Telp. 0622 - 620326, Fax - 0622 - 620327</i>
        </p>
    </div>
    <hr style="width:50%;text-align:left;margin-left:0">
    <center>
        <p style="font-size: medium; font-weight: bold; font-family:sans-serif"><?= $title ?><br><a style="font-size: small;">RECEIVING MATERIAL</a></p>
    </center>
    <div class="bold">
        <p style="font-size: 12px; font-family: sans-serif"><?= $date ?></p>
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 10px;">NO</th>
                <th rowspan="2" style="width: 50px;">DATE</th>
                <th rowspan="2" style="width: 50px;">POLICE NO.</th>
                <th rowspan="2">WB TICKET NO.</th>
                <th colspan="2">TIME</th>
                <th rowspan="2" style="width: 130px;">SUPPLIER</th>
                <th rowspan="2">PO NO.</th>
                <th rowspan="2" style="width: 110px;">COMMODITY</th>
                <th colspan="3">WEIGHBRIDGE SUPPLIER</th>
                <th colspan="3">WEIGHBRIDGE PT.DAP</th>
                <th colspan="2">Balance(Kg/Ltr)</th>
            </tr>
            <tr>
                <th>IN</th>
                <th>OUT</th>
                <th>GROSS</th>
                <th>TARE</th>
                <th>NETTO</th>
                <th>GROSS</th>
                <th>TARE</th>
                <th>NETTO</th>
                <th>(Kg/Ltr)</th>
                <th>(%)</th>
            </tr>
            <tr>
                <th colspan="17"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            foreach ($header as $value) {
                $count = $count + 1;
                $netto = $value['brt_1'] - $value['brt_2'];
                $kage = $value['tmb_netto_rls'] - $netto;
                if ($kage > 0) {
                    $percent =  0 - $kage / $value['tmb_netto_rls'] * 100;
                } else {
                    $percent = 0 -  $kage /  $value['tmb_netto_rls'] * 100;
                }
                $persen = number_format($percent, 2);
            ?>

                <tr>
                    <td><?= $count ?></td>
                    <td><?= date('d-M-Y', strtotime($value['tgl_msk'])) ?></td>
                    <td><?= $value['no_pol'] ?></td>
                    <td><?= $value['no_seri'] ?></td>
                    <td><?= $value['jam_msk'] ?></td>
                    <td><?= $value['jam_klr'] ?></td>
                    <td><?= $value['nm_rls'] ?></td>
                    <td><?= $value['no_ref'] ?></td>
                    <td><?= $value['nm_brg'] ?></td>
                    <td><?= number_format($value['tmb_gross_rls']) ?></td>
                    <td><?= number_format($value['tmb_tare_rls']) ?></td>
                    <td><?= number_format($value['tmb_netto_rls']) ?></td>
                    <td><?= number_format($value['brt_1']) ?></td>
                    <td><?= number_format($value['brt_2']) ?></td>
                    <td><?= number_format($netto) ?></td>
                    <td><?= $kage ?></td>
                    <td><?= $persen . "%" ?></td>
                </tr>
        </tbody>
    <?php } ?>
    </table>

    <div id="footer">
        <p class="page">Page
    </div>

</body>

</html>
<!-- <script>
    window.print();
</script> -->