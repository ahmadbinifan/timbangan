<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Report extends CI_Model
{
    private $table = 'tb_timbangan_dap';
    private $dsip = 'tb_timbangan_dsip';

    public function filter()
    {
        // $start = $this->input->post('tgl_msk');
        // $end = $this->input->post('tgl_klr');
        $no_ref = $this->input->post('no_ref');
        $no_ref2 = $this->input->post('no_ref2');
        // if ($start && $end) {
        //     $this->db->where('tgl_msk>=', date('Y-m-d', strtotime($start)));
        //     $this->db->where('tgl_msk<=', date('Y-m-d', strtotime($end)));
        // }
        if ($no_ref) {
            $this->db->where('no_ref', $no_ref);
        }
        if ($no_ref2) {
            $this->db->like('no_ref', $no_ref2);
        }


        $this->db->select('*')
            ->from($this->table)
            ->where('no_seri');
        $data = $this->db->get()->row();
        return $data;
    }

    public function filterPriode($start, $end, $no_ref)
    {
        $this->db->select('*')->from($this->table);
        $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        if ($no_ref != null) {
            $this->db->where('no_ref', $no_ref);
        } else {
            $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        }

        $this->db->where('ctatus', 'MSK');
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function filterPriode_excel($start, $end, $no_ref)
    {
        $this->db->select('*')->from($this->table);
        $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        if ($no_ref != null) {
            $this->db->where('no_ref', $no_ref);
        } else {
            $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        }
        $this->db->where('ctatus', 'MSK');
        $result = $this->db->get()->result();
        return $result;
    }
    public function filterPriode_excel_dsip($start, $end, $no_ref)
    {
        $this->db->select('*')->from($this->dsip);
        $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        if ($no_ref != null) {
            $this->db->where('no_ref', $no_ref);
        } else {
            $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        }
        $this->db->where('ctatus', 'MSK');
        $result = $this->db->get()->result();
        return $result;
    }
    public function filterPriode_dsip($start, $end, $no_ref)
    {
        $this->db->select('*')->from($this->dsip);
        $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        if ($no_ref != null) {
            $this->db->where('no_ref', $no_ref);
        } else {
            $this->db->where('tgl_klr >=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_klr <=', date('Y-m-d', strtotime($end)));
        }
        $this->db->where('ctatus', 'MSK');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get($params)
    {
        return $this->db->select('nm_rls , nm_brg')->where('no_ref', $params)->get($this->table)->row();
    }


    public function print($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_priode($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_priode', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_priode_dsip($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report_dsip/print_priode', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_dsip($fileName, $data)
    {
        $data['logo'] = $this->pdfImage_dsip();
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report_dsip/print', $data, TRUE);
        $this->pdf->generate($html);
    }

    public function pdfImage()
    {
        header("Content-type: application/pdf");
        $path = base_url('assets/dist/img/default/logon.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    public function pdfImage_dsip()
    {
        header("Content-type: application/pdf");
        $path = base_url('assets/dist/img/default/logon.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}

/* End of file M_Report.php */
