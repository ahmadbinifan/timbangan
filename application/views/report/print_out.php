<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @page {

            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 0.5cm;
            margin-right: 0.5cm;
        }

        /* body {
            margin: 3px;
        } */

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
        }

        td {
            border: 1px solid black;
            font-size: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
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

    <p class="form"> Form No : F-WHS-021<br>
        Issued : Jan 02,2020<br>
        Rev. No : 01</p>

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
        <p style="font-size: medium; font-weight: bold;"><?= $title ?><br><a style="font-size: small;">ISSUING MATERIAL</a></p>
    </center>
    <div class="bold">Report Date<span class="tab" style="margin-left: 28px;"> : <?php
                                                                                    echo date("d M Y");
                                                                                    ?></div>
    <div class="bold">Commodity <span class="tab" style="margin-left: 24px;"></span> : <?= $header['nm_brg'] ?></div>
    <div class="bold">Conract no.<span class="tab" style="margin-left: 27px"></span> : <?= $header['no_ref'] ?> </div>
    <div class="bold">Destination<span class="tab" style="margin-left: 30px;"> : <?= $header['nm_rls'] ?></div>
    <div class="bold">Fringe no.<span class="tab" style="margin-left: 35px;"> : _________</div>
    <div class="bold">Quantity<span class="tab" style="margin-left: 41px;"> : <?= number_format($header['Qty_PO']) ?> Kg</div>

    <table style="width: 100%;">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2" style="width: 50px;">DATE</th>
                <th rowspan="2" style="width: 50px;">POL NO.</th>
                <th rowspan="2">WB TICKET NO.</th>
                <th colspan="2">TIME (WIB)</th>
                <th rowspan="2">CONTAINER NO.</th>
                <th rowspan="2" style="width: 100px;">SEAL NO.</th>
                <th rowspan="2" style="width: 130px;">TRANSPORTATION</th>
                <th rowspan="2">NETTO (KG)</th>
                <th rowspan="2">PACKAGE TYPE</th>
                <th rowspan="2">CONTAINER TYPE</th>
                <th rowspan="2">SPLIT PO</th>
            </tr>
            <tr>
                <th>IN</th>
                <th>OUT</th>
            </tr>
            <tr>
                <th colspan="13"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            $total = 0;
            foreach ($more as $value) {
                $count = $count + 1;
                $netto = $value['brt_2'] - $value['brt_1'];
                $total += ($netto);
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= date('d-M-Y', strtotime($value['tgl_msk'])) ?></td>
                    <td><?= $value['no_pol'] ?></td>
                    <td><?= $value['no_seri'] ?></td>
                    <td><?= $value['jam_msk'] ?></td>
                    <td><?= $value['jam_klr'] ?></td>
                    <td><?= $value['no_con'] ?></td>
                    <td><?= $value['no_seal'] ?></td>
                    <td><?= $value['transport'] ?></td>
                    <td><?= number_format($netto) ?></td>
                    <td><?= $value['Package_Type'] ?></td>
                    <td><?= $value['Container_Type'] ?></td>
                    <td><?= $value['NoPO_Split'] ?></td>
                </tr>
        </tbody>
    <?php } ?>
    <tfoot>
        <tr>
            <td colspan="13"></td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: left; font-weight :bold"><span class="tab"></span> TOTAL</td>
            <td colspan="4"><?= number_format($total) ?> Kg</td>
        </tr>
    </tfoot>
    </table>
    <?php
    $balanceFooter = 0;
    $balanceFooter =  $total - $header['Qty_PO'];
    $percentFooter =  $balanceFooter / $total * 100;
    ?>
    <p>Total <span class="tab" style="margin-left:38px;"></span> : <?= $total ?> Kg/Ltr <br>
        Balance <span class="tab" style="margin-left:26px ;"></span> : <?= number_format(abs($balanceFooter)) ?> Kg/Ltr
        <?php if ($balanceFooter < 0) {
            echo "(Less)";
        } elseif ($balanceFooter == 0) {
            echo "";
        } else {
            echo "(Over)";
        } ?>
        <br>
        Percentage <span class="tab" style="margin-left: 14px;"></span> : <?= number_format(abs($percentFooter), 2) ?>%
        <?php if ($percentFooter < 0) {
            echo "(Less)";
        } elseif ($percentFooter == 0) {
            echo "";
        } else {
            echo  "(Over)";
        } ?>
    </p>
</body>

</html>
<!-- <script>
    window.print();
</script> -->