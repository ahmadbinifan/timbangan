<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
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

        .bold {
            font-weight: bold;
            font-size: 10px;
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

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>


    <title>Weighbridge Report</title>
</head>

<body>

    <h3><?= $title ?></h3>
    <div class="bold">Commodity : <?= $header['nm_brg'] ?></div>
    <div class="bold">Conract no. / PO No. : <?= $header['no_ref'] ?> </div>
    <div class="bold">Supplier : <?= $header['nm_rls'] ?></div>
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
        </thead>

        <tbody>
            <?php
            $count = 0;
            $totalNetto = 0;
            $totalSupp = 0;
            $totalKage = 0;
            $totalPers = 0;
            $percent = 0;
            foreach ($more as $value) {
                $count = $count + 1;
                $netto = ($value['brt_1']) - ($value['brt_2']);
                $kage = $netto - ($value['tmb_rls']);

                if ($kage > 0) {
                    $percent =  0 - $kage / ($value['tmb_rls']) * 100;
                } else {
                    $percent = 0 -  $kage / ($value['tmb_rls']) * 100;
                }
                $persen = number_format($percent, 2);
                $totalNetto += ($netto);
                $totalSupp += ($value['tmb_rls']);
                $totalKage = $totalNetto - $totalSupp;
                if ($totalKage > 0) {
                    $totalPers = 0 - $totalKage / $totalSupp * 100;
                } else {
                    $totalPers = 0 - $totalKage / $totalSupp * 100;
                }
                $topers = number_format($totalPers, 2);

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
                    <td><?= number_format($value['tmb_rls']) ?> </td>
                    <td><?= $value['temps'] ?> </td>
                    <td><?= $value['density'] ?> </td>
                    <td><?= $kage ?> </td>
                    <td><?= $persen . "%" ?> </td>
                </tr>
        </tbody>
    <?php } ?>
    <tfoot>
        <tr>
            <td colspan="10" align="left">TOTAL</td>
            <td><?= number_format($totalNetto) ?></td>
            <td><?= number_format($totalSupp) ?></td>
            <td colspan="2"></td>
            <td><?= number_format($totalKage) ?></td>
            <td><?= $topers . "%" ?></td>
            <!-- <td colspan="16" align="left">Total</td>
            <td colspan="16" align="left">Total</td> -->
        </tr>
    </tfoot>
    </table>
</body>

</html>
<!-- <script>
    window.print();
</script> -->