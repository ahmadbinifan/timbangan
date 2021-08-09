<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reject_ticket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        rejectAccess();
        $this->load->model(['M_Reject_Ticket' => 'reject_ticket', 'M_Timbangan' => 'weighbridge']);
    }

    public function index()
    {
        rejectAccess();
        $data = [
            'title' => 'PT. DAP - Wighbridge ',
            // 'nm_rls' => $this->weighbridge->get_rls(),
            // 'no_ref' => $this->reject_ticket->get_noRef(),
            // 'nm_brg' => $this->reject_ticket->get_barang(),
        ];

        backView('reject_ticket/index', $data);
    }

    public function ajax_list()
    {
        rejectAccess();
        $list = $this->reject_ticket->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $netto = (int)$value->brt_1 - (int)$value->brt_2;

            if ($value->tgl_klr == null) {
                $tgl_klr = "<div class='badge badge-info'>Unloading</div>";
            } elseif ($value->tgl_klr) {
                $tgl_klr = date('Y-m-d', strtotime($value->tgl_klr));
            }
            if ($value->jam_klr == null) {
                $jam_klr = "<div class='badge badge-info'>Unloading</div>";
            } elseif ($value->tgl_klr) {
                $jam_klr = $value->jam_klr;
            }
            if ($value->brt_2 == null) {
                $brt_2 = "<div class='badge badge-info'>Unloading</div>";
            } elseif ($value->brt_2) {
                $brt_2 = number_format($value->brt_2);
            }
            if ($value->Split_PO == 1) {
                $split_po = "<div class='badge badge-success'>Yes</div>";
            } else {
                $split_po = "<div class='badge badge-warning'>No</div>";
            }
            if ($value->completion == 1) {
                $completion = "<div class='badge badge-success'>Completed</div>";
            } elseif ($value->completion == 2) {
                $completion = "<div class='badge badge-warning'>Loading/Unloading</div>";
            } elseif ($value->completion == 3) {
                $completion = "<div class='badge badge-danger'>Reject</div>";
                $brt_2 = "<div class='badge badge-danger'>Reject</div>";
            }


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->no_seri;
            $row[] = $value->vcf_No;
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
            $row[] = $value->NoPO_Split;
            // $row[] = $completion;
            $reject = "\"" . $value->no_seri . "\"";
            $btn_reject =
                "<button type='button' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Reject?' onclick='reject(" . $reject . ")' >
            <i class='fas fa-exclamation-circle '></i>
            </button>";

            if ($value->completion == 1 || $value->completion == 2) {
                $action = $btn_reject;
            } else {
                $action = "<div class='badge badge-danger'>has been rejected</div>";
            }
            $row[] = "<div class='row'>" . $action . "</div>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reject_ticket->count_all(),
            "recordsFiltered" => $this->reject_ticket->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function reject()
    {
        $id = $this->input->post('id');
        $res = $this->reject_ticket->reject($id);
        echo json_encode($res);
    }
}

/* End of file Reject_ticket.php */
