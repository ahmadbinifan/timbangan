<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Weighbridge_priode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Timbangan' => 'weighbridge']);
    }

    public function index()
    {
        adminAccess();
        $data = [
            'title' => 'PT. DAP - Wighbridge In',
            // 'nm_rls' => $this->weighbridge->get_rls(),
            'no_ref' => $this->weighbridge->get_noRef(),
            'nm_brg' => $this->weighbridge->get_barang(),
        ];

        backView('weighbridge_priode/index', $data);
    }

    public function ajax_list()
    {
        adminAccess();
        $list = $this->weighbridge->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $netto = (int)$value->brt_1 - (int)$value->brt_2;

            if ($value->tgl_klr == null) {
                $tgl_klr = "<div class='badge badge-danger'>Unloading</div>";
            } elseif ($value->tgl_klr) {
                $tgl_klr = date('Y-m-d', strtotime($value->tgl_klr));
            }
            if ($value->jam_klr == null) {
                $jam_klr = "<div class='badge badge-danger'>Unloading</div>";
            } elseif ($value->tgl_klr) {
                $jam_klr = $value->jam_klr;
            }
            if ($value->brt_2 == null) {
                $brt_2 = "<div class='badge badge-danger'>Unloading</div>";
            } elseif ($value->brt_2) {
                $brt_2 = number_format($value->brt_2);
            }
            if ($value->Split_PO == 1) {
                $split_po = "<div class='badge badge-success'>Yes</div>";
            } else {
                $split_po = "<div class='badge badge-warning'>No</div>";
            }


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->no_seri;
            $row[] = date('Y-m-d', strtotime($value->tgl_msk));
            $row[] = $value->jam_msk;
            // $row[] = date('Y-m-d', strtotime($value->tgl_klr));
            $row[] = $tgl_klr;
            $row[] = $jam_klr;
            $row[] = number_format($value->Qty_PO);
            $row[] = $value->no_pol;
            $row[] = $value->no_con;
            $row[] = $value->nm_rls;
            $row[] = $value->no_ref;
            $row[] = $value->nm_brg;
            $row[] = number_format($value->brt_1);
            $row[] = $brt_2;
            $row[] = number_format($netto);
            $row[] = number_format($value->tmb_gross_rls);
            $row[] = number_format($value->tmb_tare_rls);
            $row[] = number_format($value->tmb_netto_rls);
            $row[] = $value->Package_Type;
            $row[] = $value->Container_Type;
            $row[] = $split_po;
            // $row[] = $cstatus;
            // $row[] = $completion;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->weighbridge->count_all(),
            "recordsFiltered" => $this->weighbridge->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function rangeDates()
    {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $return = $this->weighbridge->rangeDate($start_date, $end_date);

        echo json_encode($return);
    }

    public function get_vendor()
    {
        $params = $this->input->post('no_ref');
        $data = $this->weighbridge->get_rls($params);
        echo json_encode($data);
    }
}

/* End of file Weighbridge_priode.php */
