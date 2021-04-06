<?php
defined('BASEPATH') or exit('No direct script access allowed');

class report_out extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Timbangan_out' => 'weighbridge', 'M_Report_Out' => 'report']);
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

    public function PrintByPO($id = null)
    {
        $this->load->library('pdf');
        $data['header'] = $this->weighbridge->getHead($id);
        $data['more'] = $this->weighbridge->getMore($id);
        $data['title'] = "Weighbridge Report";
        $data['data'] = $this->report->filter();
        $filename = "Print " . date('d-F-Y H:i:s');
        $this->report->print($filename, $data);
        echo json_encode($data);

        $this->load->view('report_out/print', $data);
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
