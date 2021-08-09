<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @page {

            margin-top: 1cm;
            margin-bottom: 2.5cm;
            margin-left: 1cm;
            margin-right: 1cm;
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

    <p class="form"> Form No : F-WHS-020<br>
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

        <p style="font-size: medium; font-weight: bold;"><?= $title ?><br><a style="font-size: small;">RECEIVING MATERIAL</a></p>

    </center>
    <div class="bold">Report Date<span class="tab" style="margin-left: 41px;"> : <?php
                                                                                    echo date("d M Y");
                                                                                    ?></div>
    <div class="bold">Commodity <span class="tab" style="margin-left: 37px;"></span> : <?= $header['nm_brg'] ?></div>
    <div class="bold">Conract no. / PO No. <span class="tab" style="margin-left: 1px"></span> : <?= $header['no_ref'] ?> </div>
    <div class="bold">Supplier<span class="tab" style="margin-left: 57px;"> : <?= $header['nm_rls'] ?></div>
    <div class="bold">Quantity<span class="tab" style="margin-left: 56px;"> : <?= $header['Qty_PO'] ?></div>
    <br>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">DATE</th>
                <th rowspan="2">POLICE NO.</th>
                <th rowspan="2">WB TICKET NO.</th>
                <th colspan="2">TIME</th>
                <th rowspan="2">TRANSPORTATION</th>
                <th rowspan="2">SEAL NO.</th>
                <th colspan="3">WEIGHBRIDGE (KG)</th>
                <th rowspan="2">Supplier (Kg/Ltr)</th>
                <th rowspan="2">Temp (*C)</th>
                <th rowspan="2">Density</th>
                <th colspan="2">Balance(Kg/Ltr)</th>
                <th rowspan="2">Split PO</th>
                <th rowspan="2">WB</th>
                <th rowspan="2">R</th>
            </tr>
            <tr>
                <th>IN</th>
                <th>OUT</th>
                <th>GROSS</th>
                <th>TARE</th>
                <th>NETTO</th>
                <th>(Kg/Ltr)</th>
                <th>(%)</th>
            </tr>
            <tr>
                <th colspan="19"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            $totalNetto = 0;
            $totalSupp = 0;
            $totalKage = 0;
            $totalPers = 0;
            $percent = 0;
            $topers = 0;
            foreach ($more as $value) {
                $count = $count + 1;
                $netto = ($value['brt_1']) - ($value['brt_2']);
                if ($value['brt_2'] == null) {
                    $netto = ($value['brt_1'] * 0);
                }

                $kage = $netto - $value['tmb_netto_rls'];
                if ($value['brt_2'] == null) {
                    $kage = 0 * $value['tmb_netto_rls'];
                }

                if ($kage > 0) {
                    $percent =  0 - $kage / $value['tmb_netto_rls'] * 100;
                } elseif ($kage == 0) {
                    $percent = 0;
                } else {
                    $percent = 0 -  $kage /  $value['tmb_netto_rls'] * 100;
                }
                $persen = number_format($percent, 2);
                $totalNetto += ($netto);
                $totalSupp +=  $value['tmb_netto_rls'];
                $totalKage = $totalNetto - $totalSupp;

                if ($totalKage > 0) {
                    $totalPers = 0 - $totalKage / $totalSupp * 100;
                } else {
                    $totalPers = 0 - $totalKage / $totalSupp * 100;
                }
                $topers = number_format($totalPers, 2);

                if ($value['completion'] == 1) {
                    $completion = "";
                } elseif ($value['completion'] == 2) {
                    $completion = "";
                } elseif ($value['completion'] == 3) {
                    $completion = "R";
                }

            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= date('d-M-Y', strtotime($value['tgl_msk'])) ?></td>
                    <td><?= $value['no_pol'] ?> </td>
                    <td><?= $value['no_seri'] ?> </td>
                    <td><?= $value['jam_msk'] ?> </td>
                    <td><?= $value['jam_klr'] ?> </td>
                    <td><?= $value['transport'] ?> </td>
                    <td><?= $value['no_seal'] ?> </td>
                    <td><?= number_format($value['brt_1']) ?> </td>
                    <td><?= number_format($value['brt_2']) ?> </td>
                    <td><?= number_format($netto) ?></td>
                    <td><?= number_format($value['tmb_netto_rls']) ?> </td>
                    <td><?= $value['temps'] ?> </td>
                    <td><?= $value['density'] ?> </td>
                    <td><?= $kage ?> </td>
                    <td><?= $persen . "%" ?> </td>
                    <td><?= $value['NoPO_Split'] ?></td>
                    <td><?= $value['Type_Wb'] ?></td>
                    <td><?= $completion ?></td>
                </tr>

        </tbody>
    <?php } ?>
    <tfoot>
        <tr>
            <td colspan="19"></td>
        </tr>
        <tr>
            <td colspan="10" align="left">TOTAL</td>
            <td><?= number_format($totalNetto) ?></td>
            <td><?= number_format($totalSupp) ?></td>
            <td colspan="2"></td>
            <td><?= number_format($totalKage) ?></td>
            <td><?= $topers . "%" ?></td>
            <td colspan="3"></td>
            <!-- <td colspan="16" align="left">Total</td>
            <td colspan="16" align="left">Total</td> -->
        </tr>
    </tfoot>
    </table>
    <?php
    $balanceFooter = 0;
    $balanceFooter = $totalNetto - $header['Qty_PO'];
    $percentFooter =  $balanceFooter / $totalNetto * 100;
    ?>
    <p>Note<span class="tab" style="margin-left:42px ;"></span> : R = Reject <br>Total Received : <?= number_format($totalNetto) ?> Kg/Ltr <br>
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