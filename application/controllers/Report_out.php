<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class report_out extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Timbangan_out' => 'weighbridge', 'M_Timbangan_Out_Dsip' => 'weighbridge_dsip', 'M_Report_Out' => 'report']);
    }

    public function index()
    {

        $data = [
            'title' => 'PT. DAP - Report Weighbridge OUT',
            // 'nm_rls' => $this->weighbridge->get_rls(),
            'no_ref' => $this->weighbridge->get_noRef(),
            'nm_brg' => $this->weighbridge->get_barang(),
        ];

        backView('report_out/index', $data);
    }

    public function PrintByContract($part1 = null, $part2 = null)
    {

        $id = urldecode($part1) . "/" . ($part2);
        $this->load->library('pdf');
        $data['header'] = $this->weighbridge->getHead($id);
        $data['more'] = $this->weighbridge->getMore($id);
        $data['title'] = "WEIGHBRIDGE REPORT";
        // $data['data'] = $this->report->filter();
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print($filename, $data);
        echo json_encode($data);

        $this->load->view('report/print_out', $data);
    }

    public function printByPriode($start = null, $end = null, $part1 = null, $part2 = null)
    {
        $no_ref = $part1 . "/" . urldecode($part2);
        $this->load->library('Pdf');
        // $data['more'] = $this->weighbridge->getMore($start, $end);
        $data['title'] = "WEIGHBRIDGE REPORT";
        $data['date'] = "Priod Date : " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filterPriode(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)), $no_ref);
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print_priode($filename, $data);
        echo json_encode($data);

        $this->load->view('report/print_priode_out', $data);
    }
    public function printByPriodeDsip($start = null, $end = null, $part1 = null, $part2 = null, $part3 = null, $part4 = null, $part5 = null)
    {
        $no_ref = $part1 . "/" . $part2 . "/" . ($part3) . "/" . $part4 . "/" . $part5;
        $this->load->library('Pdf');
        // $data['more'] = $this->weighbridge->getMore($start, $end);
        $data['title'] = "WEIGHBRIDGE REPORT";
        $data['date'] = "Priod Date : " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filterPriode_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)), $no_ref);
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print_priode_dsip($filename, $data);
        echo json_encode($data);

        $this->load->view('report_dsip/print_priode_out', $data);
    }

    public function PrintByContract_dsip($part1 = null, $part2 = null, $part3 = null, $part4 = null, $part5 = null)
    {
        $id = $part1 . "/" . $part2 . "/" . ($part3) . "/" . $part4 . "/" . $part5;
        // var_dump($id);
        // die;
        $this->load->library('pdf');
        $data['header'] = $this->weighbridge_dsip->getHead($id);
        $data['more'] = $this->weighbridge_dsip->getMore($id);
        $data['title'] = "WEIGHBRIDGE REPORT";
        // $data['data'] = $this->report->filter();
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print_dsip($filename, $data);
        echo json_encode($data);

        $this->load->view('report_dsip/print_out', $data);
    }

    public function phpExcel_wb($part1 = null, $part2 = null)
    {
        $id = $part1 . "/" . urldecode($part2);
        $data['title'] = "Weighbridge Report - PT. Domas Agrointi Prima (DAP)";
        $data['header'] = $this->weighbridge->getHead($id);
        $data['more'] = $this->weighbridge->getExcel($id);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('WB Report');

        // Add some data      
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'PT. Domas Agrointi Prima (DAP)')
            ->mergeCells('A1:D1')
            ->setCellValue('A2', 'NO CONTRACT')
            ->mergeCells('A2:D2')
            ->setCellValue('A3', 'ISSUING MATERIAL')
            ->mergeCells('A3:N3')
            ->setCellValue('A4', 'NO')
            ->mergeCells('A4:A5')
            ->setCellValue('B4', 'DATE')
            ->mergeCells('B4:B5')
            ->setCellValue('C4', 'POLICE NO.')
            ->mergeCells('C4:C5')
            ->setCellValue('D4', 'WB TICKET NO.')
            ->mergeCells('D4:D5')
            ->setCellValue('E4', 'TIME')
            ->mergeCells('E4:F4')
            ->setCellValue('E5', 'IN')
            ->setCellValue('F5', 'OUT')
            ->setCellValue('G4', 'CONTAINER NO.')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'SEAL NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'TRANSPORTATION')
            ->mergeCells('I4:I5')
            ->setCellValue('J4', 'NETTO (KG)')
            ->mergeCells('J4:J5')
            ->setCellValue('K4', 'PACKAGE TYPE')
            ->mergeCells('K4:K5')
            ->setCellValue('L4', 'CONTAINER TYPE')
            ->mergeCells('L4:L5')
            ->setCellValue('M4', 'SPLIT PO')
            ->mergeCells('M4:M5')
            ->setCellValue('N4', 'WB')
            ->mergeCells('N4:N5');



        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $count = 0;
        $total = 0;

        foreach ($data['more'] as $value) {

            $netto = $value->brt_2 - $value->brt_1;
            $count = $count + 1;
            $total += $netto;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $judul, $id)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->tgl_msk)
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->no_con)
                ->setCellValue('H' . $i, $value->no_seal)
                ->setCellValue('I' . $i, $value->transport)
                ->setCellValue('J' . $i, $netto)
                ->setCellValue('K' . $i, $value->Package_Type)
                ->setCellValue('L' . $i, $value->Container_Type)
                ->setCellValue('M' . $i, $value->NoPO_Split)
                ->setCellValue('N' . $i, $value->Type_Wb);

            $i++;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $i, 'TOTAL');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:N')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Issuing Material ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Weighbridge PT.DAP Issuing Material " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
    public function phpExcel_wb_dsip($part1 = null, $part2 = null, $part3 = null, $part4 = null, $part5 = null)
    {
        $id = $part1 . "/" . $part2 . "/" . ($part3) . "/" . $part4 . "/" . $part5;
        $data['title'] = "Weighbridge Report - PT. Domas Sawit Inti Perdana (DSIP)";
        $data['header'] = $this->weighbridge_dsip->getHead($id);
        $data['more'] = $this->weighbridge_dsip->getExcel($id);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('WB Report');

        // Add some data      
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'PT. Domas Sawit Inti Perdana (DSIP)')
            ->mergeCells('A1:D1')
            ->setCellValue('A2', 'NO CONTRACT')
            ->mergeCells('A2:D2')
            ->setCellValue('A3', 'ISSUING MATERIAL')
            ->mergeCells('A3:N3')
            ->setCellValue('A4', 'NO')
            ->mergeCells('A4:A5')
            ->setCellValue('B4', 'DATE')
            ->mergeCells('B4:B5')
            ->setCellValue('C4', 'POLICE NO.')
            ->mergeCells('C4:C5')
            ->setCellValue('D4', 'WB TICKET NO.')
            ->mergeCells('D4:D5')
            ->setCellValue('E4', 'TIME')
            ->mergeCells('E4:F4')
            ->setCellValue('E5', 'IN')
            ->setCellValue('F5', 'OUT')
            ->setCellValue('G4', 'CONTAINER NO.')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'SEAL NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'TRANSPORTATION')
            ->mergeCells('I4:I5')
            ->setCellValue('J4', 'NETTO (KG)')
            ->mergeCells('J4:J5')
            ->setCellValue('K4', 'PACKAGE TYPE')
            ->mergeCells('K4:K5')
            ->setCellValue('L4', 'CONTAINER TYPE')
            ->mergeCells('L4:L5')
            ->setCellValue('M4', 'SPLIT PO')
            ->mergeCells('M4:M5')
            ->setCellValue('N4', 'WB')
            ->mergeCells('N4:N5');



        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $count = 0;
        $total = 0;

        foreach ($data['more'] as $value) {

            $netto = $value->brt_2 - $value->brt_1;
            $count = $count + 1;
            $total += $netto;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $judul, $id)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->tgl_msk)
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->no_con)
                ->setCellValue('H' . $i, $value->no_seal)
                ->setCellValue('I' . $i, $value->transport)
                ->setCellValue('J' . $i, $netto)
                ->setCellValue('K' . $i, $value->Package_Type)
                ->setCellValue('L' . $i, $value->Container_Type)
                ->setCellValue('M' . $i, $value->NoPO_Split)
                ->setCellValue('N' . $i, $value->Type_Wb);

            $i++;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $i, 'TOTAL');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:N')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Issuing Material ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Weighbridge PT.DSIP Issuing Material " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function phpExcel_wb_priode($start = null, $end = null, $part1 = null, $part2 = null)
    {
        $no_ref = $part1 . "/" . urldecode($part2);
        $data['title'] = "Weighbridge Report - PT. Domas Agrointi Prima (DAP)";
        $data['subtitle'] = "From Date : " . date('d-F-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->filterPriode_excel(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)), $no_ref);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('WB Report');

        // Add some data      
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'PT. Domas Agrointi Prima (DAP)')
            ->mergeCells('A1:E1')
            ->setCellValue('A2', 'Priod Date : ' . date('d-F-Y', strtotime($start)) . " To " . date('d-F-Y', strtotime($end)))
            ->mergeCells('A2:E2')
            ->setCellValue('A4', 'NO')
            ->mergeCells('A4:A5')
            ->setCellValue('B4', 'DATE')
            ->mergeCells('B4:B5')
            ->setCellValue('C4', 'POLICE NO.')
            ->mergeCells('C4:C5')
            ->setCellValue('D4', 'WB TICKER_MO.')
            ->mergeCells('D4:D5')
            ->setCellValue('E4', 'TIME')
            ->mergeCells('E4:F4')
            ->setCellValue('E5', 'IN')
            ->setCellValue('F5', 'OUT')
            ->setCellValue('G4', 'CUSTOMER')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'CONTRACT NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'COMMODITY')
            ->mergeCells('I4:I5')
            ->setCellValue('J4', 'TRANSPORTATION')
            ->mergeCells('J4:J5')
            ->setCellValue('K4', 'CONTAINER NO.')
            ->mergeCells('K4:K5')
            ->setCellValue('L4', 'WEIGHBRIDGE')
            ->mergeCells('L4:N4')
            ->setCellValue('L5', 'GROSS')
            ->setCellValue('M5', 'TARE')
            ->setCellValue('N5', 'NETTO')
            ->setCellValue('O4', 'PACKAGE')
            ->mergeCells('O4:O5')
            ->setCellValue('P4', 'CONTAINER TYPE')
            ->mergeCells('P4:P5')
            ->setCellValue('Q4', 'SPLIT PO')
            ->mergeCells('Q4:Q5')
            ->setCellValue('R4', 'WB')
            ->mergeCells('R4:R5');

        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $total = 0;
        $count = 0;

        foreach ($data['datafilter'] as $value) {

            $netto = $value->brt_2 - $value->brt_1;
            $kage = $netto - $value->tmb_netto_rls;
            $percent = $kage / $netto * 100;
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, date('d-F-Y', strtotime($value->tgl_msk)))
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->nm_rls)
                ->setCellValue('H' . $i, $value->no_ref)
                ->setCellValue('I' . $i, $value->nm_brg)
                ->setCellValue('J' . $i, $value->transport)
                ->setCellValue('K' . $i, $value->no_con)
                ->setCellValue('L' . $i, ($value->brt_2))
                ->setCellValue('M' . $i, ($value->brt_1))
                ->setCellValue('N' . $i, $netto)
                ->setCellValue('O' . $i, $value->Package_Type)
                ->setCellValue('P' . $i, $value->Container_Type)
                ->setCellValue('Q' . $i, $value->NoPO_Split)
                ->setCellValue('R' . $i, $value->Type_Wb);

            $i++;
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, 'TOTAL');
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:R')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Receiving Material ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Weighbridge PT.DSIP Receiving Material " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
    public function phpExcel_wb_dsip_priode($start = null, $end = null, $part1 = null, $part2 = null, $part3 = null, $part4 = null, $part5 = null)
    {
        $no_ref = $part1 . "/" . $part2 . "/" . ($part3) . "/" . $part4 . "/" . $part5;
        $data['title'] = "Weighbridge Report - PT. Domas Sawit Inti Perdana (DSIP)";
        $data['subtitle'] = "From Date : " . date('d-F-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->filterPriode_excel_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)), $no_ref);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('WB Report');

        // Add some data      
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'PT. Domas Sawit Inti Perdana (DSIP)')
            ->mergeCells('A1:E1')
            ->setCellValue('A2', 'Priod Date : ' . date('d-F-Y', strtotime($start)) . " To " . date('d-F-Y', strtotime($end)))
            ->mergeCells('A2:E2')
            ->setCellValue('A4', 'NO')
            ->mergeCells('A4:A5')
            ->setCellValue('B4', 'DATE')
            ->mergeCells('B4:B5')
            ->setCellValue('C4', 'POLICE NO.')
            ->mergeCells('C4:C5')
            ->setCellValue('D4', 'WB TICKER_MO.')
            ->mergeCells('D4:D5')
            ->setCellValue('E4', 'TIME')
            ->mergeCells('E4:F4')
            ->setCellValue('E5', 'IN')
            ->setCellValue('F5', 'OUT')
            ->setCellValue('G4', 'CUSTOMER')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'CONTRACT NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'COMMODITY')
            ->mergeCells('I4:I5')
            ->setCellValue('J4', 'TRANSPORTATION')
            ->mergeCells('J4:J5')
            ->setCellValue('K4', 'CONTAINER NO.')
            ->mergeCells('K4:K5')
            ->setCellValue('L4', 'WEIGHBRIDGE')
            ->mergeCells('L4:N4')
            ->setCellValue('L5', 'GROSS')
            ->setCellValue('M5', 'TARE')
            ->setCellValue('N5', 'NETTO')
            ->setCellValue('O4', 'PACKAGE')
            ->mergeCells('O4:O5')
            ->setCellValue('P4', 'CONTAINER TYPE')
            ->mergeCells('P4:P5')
            ->setCellValue('Q4', 'SPLIT PO')
            ->mergeCells('Q4:Q5')
            ->setCellValue('R4', 'WB')
            ->mergeCells('R4:R5');

        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $total = 0;
        $count = 0;

        foreach ($data['datafilter'] as $value) {

            $netto = $value->brt_2 - $value->brt_1;
            $kage = $netto - $value->tmb_netto_rls;
            $percent = $kage / $netto * 100;
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, date('d-F-Y', strtotime($value->tgl_msk)))
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->nm_rls)
                ->setCellValue('H' . $i, $value->no_ref)
                ->setCellValue('I' . $i, $value->nm_brg)
                ->setCellValue('J' . $i, $value->transport)
                ->setCellValue('K' . $i, $value->no_con)
                ->setCellValue('L' . $i, ($value->brt_2))
                ->setCellValue('M' . $i, ($value->brt_1))
                ->setCellValue('N' . $i, $netto)
                ->setCellValue('O' . $i, $value->Package_Type)
                ->setCellValue('P' . $i, $value->Container_Type)
                ->setCellValue('Q' . $i, $value->NoPO_Split)
                ->setCellValue('R' . $i, $value->Type_Wb);

            $i++;
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, 'TOTAL');
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:R')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Issuing Material ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Weighbridge PT.DSIP Issuing Material " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }


    public function get_vendor()
    {
        $params = $this->input->post('no_ref');
        $data = $this->weighbridge->get_rls($params);
        echo json_encode($data);
    }

    public function get_ref()
    {
        $params = $this->input->post('ctatus');
        $data = $this->weighbridge->get_ref($params);
        echo json_encode($data);
    }
}



/* End of file weighbridge.php */
