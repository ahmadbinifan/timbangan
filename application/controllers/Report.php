<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
// End load library phpspreadsheet
class report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Timbangan' => 'weighbridge', 'M_Timbangan_Dsip' => 'weighbridge_dsip', 'M_Report' => 'report']);
    }

    public function index()
    {

        $data = [
            'title' => 'PT. DAP - Report Weighbridge IN',
            // 'nm_rls' => $this->weighbridge->get_rls(),
            'no_ref' => $this->weighbridge->get_noRef(),
            'nm_brg' => $this->weighbridge->get_barang(),
        ];

        backView('report/index', $data);
    }


    public function PrintByPO($id = null)
    {
        $this->load->library('Pdf');
        $data['header'] = $this->weighbridge->getHead($id);
        $data['more'] = $this->weighbridge->getMore($id);
        $data['title'] = "WEIGHBRIDGE REPORT";
        $data['subtitle'] = "RECEIVING MATERIAL";
        // $data['data'] = $this->report->filter();
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print($filename, $data);
        echo json_encode($data);

        $this->load->view('report/print', $data);
    }

    public function printByPriode($start = null, $end = null)
    {
        $this->load->library('Pdf');
        // $data['more'] = $this->weighbridge->getMore($start, $end);
        $data['title'] = "WEIGHBRIDGE REPORT";
        $data['date'] = "Priod Date : " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filterPriode(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print_priode($filename, $data);
        echo json_encode($data);

        $this->load->view('report/print_priode', $data);
    }
    public function printByPriodeDsip($start = null, $end = null)
    {
        $this->load->library('Pdf');
        // $data['more'] = $this->weighbridge->getMore($start, $end);
        $data['title'] = "WEIGHBRIDGE REPORT";
        $data['date'] = "Priod Date : " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filterPriode_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print_priode_dsip($filename, $data);
        echo json_encode($data);

        $this->load->view('report_dsip/print_priode', $data);
    }

    public function PrintByPO_dsip($id = null)
    {
        $this->load->library('pdf');
        $data['header'] = $this->weighbridge_dsip->getHead($id);
        $data['more'] = $this->weighbridge_dsip->getMore($id);
        $data['title'] = "WEIGHBRIDGE REPORT";
        $data['subtitle'] = "RECEIVING MATERIAL";
        $data['data'] = $this->report->filter();
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print_dsip($filename, $data);
        echo json_encode($data);

        $this->load->view('report_dsip/print', $data);
    }

    public function phpExcel_wb($id = null)
    {
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
            ->setCellValue('A2', 'PO NO. :')
            ->mergeCells('A2:D2')
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
            ->setCellValue('G4', 'TRANSPORTATION')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'SEAL NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'WEIGHBRIDGE')
            ->mergeCells('I4:K4')
            ->setCellValue('I5', 'GROSS')
            ->setCellValue('J5', 'TARE')
            ->setCellValue('K5', 'NETTO')
            ->setCellValue('L4', 'Supplier (Kg/Ltr)')
            ->mergeCells('L4:L5')
            ->setCellValue('M4', 'Temp(*C)')
            ->mergeCells('M4:M5')
            ->setCellValue('N4', 'Density')
            ->mergeCells('N4:N5')
            ->setCellValue('O4', 'Balance(Kg/Ltr)')
            ->mergeCells('O4:P4')
            ->setCellValue('O5', '(Kg/Ltr)')
            ->setCellValue('P5', '(%)');


        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $count = 0;

        foreach ($data['more'] as $value) {

            $netto = $value->brt_1 - $value->brt_2;
            $kage = $netto - $value->tmb_netto_rls;
            $percent = $kage / $netto * 100;
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $judul, $id)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->tgl_msk)
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->transport)
                ->setCellValue('H' . $i, $value->no_seal)
                ->setCellValue('I' . $i, $value->brt_1)
                ->setCellValue('J' . $i, ($value->brt_2))
                ->setCellValue('K' . $i, $netto)
                ->setCellValue('L' . $i, ($value->tmb_netto_rls))
                ->setCellValue('M' . $i, ($value->temps))
                ->setCellValue('N' . $i, ($value->density))
                ->setCellValue('O' . $i, $kage)
                ->setCellValue('P' . $i, number_format($percent, 2) . "%");
            $i++;

            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, 'TOTAL');
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:P')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Receiving Material ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Weighbridge PT.DAP Receiving Material " . date('d-F-Y H:i:s');

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

    public function phpExcel_wb_priode($start = null, $end = null)
    {
        $data['title'] = "Weighbridge Report - PT. Domas Agrointi Prima (DAP)";
        $data['subtitle'] = "From Date : " . date('d-F-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->filterPriode_excel(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));

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
            ->setCellValue('A2', 'Priod Date :')
            ->mergeCells('A2:D2')
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
            ->setCellValue('G4', 'SUPPLIER')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'PO NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'COMMODITY')
            ->mergeCells('I4:I5')
            ->setCellValue('J4', 'WEIGHBRIDGE SUPPLIER')
            ->mergeCells('J4:L4')
            ->setCellValue('J5', 'GROSS')
            ->setCellValue('K5', 'TARE')
            ->setCellValue('L5', 'NETTO')
            ->setCellValue('M4', 'WEIGHBRIDGE DAP')
            ->mergeCells('M4:O4')
            ->setCellValue('M5', 'GROSS')
            ->setCellValue('N5', 'TARE')
            ->setCellValue('O5', 'NETTO')
            ->setCellValue('P4', 'BALANCE(Kg/Ltr)')
            ->mergeCells('P4:Q4')
            ->setCellValue('P5', '(Kg/Ltr)')
            ->setCellValue('Q5', '(%)');

        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $total = 0;
        $count = 0;

        foreach ($data['datafilter'] as $value) {

            $netto = $value->brt_1 - $value->brt_2;
            $kage = $netto - $value->tmb_netto_rls;
            $percent = $kage / $netto * 100;
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $judul, $start)
                ->setCellValue('F' . $judul, "To")
                ->setCellValue('G' . $judul, $end)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->tgl_msk)
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->nm_rls)
                ->setCellValue('H' . $i, $value->no_ref)
                ->setCellValue('I' . $i, $value->nm_brg)
                ->setCellValue('J' . $i, ($value->tmb_gross_rls))
                ->setCellValue('K' . $i, ($value->tmb_tare_rls))
                ->setCellValue('L' . $i, ($value->tmb_netto_rls))
                ->setCellValue('M' . $i, ($value->brt_1))
                ->setCellValue('N' . $i, ($value->brt_2))
                ->setCellValue('O' . $i, $netto)
                ->setCellValue('P' . $i, $kage)
                ->setCellValue('Q' . $i, number_format($percent, 2) . "%");
            $i++;

            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, 'TOTAL');
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:Q')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Receiving Material ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Weighbridge PT.DAP Receiving Material " . date('d-F-Y H:i:s');

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
    public function phpExcel_wb_dsip_priode($start = null, $end = null)
    {
        $data['title'] = "Weighbridge Report - PT. Domas Sawit Inti Perdana (DSIP)";
        $data['subtitle'] = "From Date : " . date('d-F-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->filterPriode_excel_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));

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
            ->setCellValue('A2', 'Priod Date :')
            ->mergeCells('A2:D2')
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
            ->setCellValue('G4', 'SUPPLIER')
            ->mergeCells('G4:G5')
            ->setCellValue('H4', 'PO NO.')
            ->mergeCells('H4:H5')
            ->setCellValue('I4', 'COMMODITY')
            ->mergeCells('I4:I5')
            ->setCellValue('J4', 'WEIGHBRIDGE SUPPLIER')
            ->mergeCells('J4:L4')
            ->setCellValue('J5', 'GROSS')
            ->setCellValue('K5', 'TARE')
            ->setCellValue('L5', 'NETTO')
            ->setCellValue('M4', 'WEIGHBRIDGE DAP')
            ->mergeCells('M4:O4')
            ->setCellValue('M5', 'GROSS')
            ->setCellValue('N5', 'TARE')
            ->setCellValue('O5', 'NETTO')
            ->setCellValue('P4', 'BALANCE(Kg/Ltr)')
            ->mergeCells('P4:Q4')
            ->setCellValue('P5', '(Kg/Ltr)')
            ->setCellValue('Q5', '(%)');

        // Miscellaneous glyphs, UTF-8

        $judul = 2;
        $i = 6;
        $total = 0;
        $count = 0;

        foreach ($data['datafilter'] as $value) {

            $netto = $value->brt_1 - $value->brt_2;
            $kage = $netto - $value->tmb_netto_rls;
            $percent = $kage / $netto * 100;
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $judul, $start)
                ->setCellValue('F' . $judul, "To")
                ->setCellValue('G' . $judul, $end)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->tgl_msk)
                ->setCellValue('C' . $i, $value->no_pol)
                ->setCellValue('D' . $i, $value->no_seri)
                ->setCellValue('E' . $i, $value->jam_msk)
                ->setCellValue('F' . $i, $value->jam_klr)
                ->setCellValue('G' . $i, $value->nm_rls)
                ->setCellValue('H' . $i, $value->no_ref)
                ->setCellValue('I' . $i, $value->nm_brg)
                ->setCellValue('J' . $i, ($value->tmb_gross_rls))
                ->setCellValue('K' . $i, ($value->tmb_tare_rls))
                ->setCellValue('L' . $i, ($value->tmb_netto_rls))
                ->setCellValue('M' . $i, ($value->brt_1))
                ->setCellValue('N' . $i, ($value->brt_2))
                ->setCellValue('O' . $i, $netto)
                ->setCellValue('P' . $i, $kage)
                ->setCellValue('Q' . $i, number_format($percent, 2) . "%");
            $i++;

            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, 'TOTAL');
            //      $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $i, $total);
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:Q')->getAlignment()->setHorizontal('center');

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
