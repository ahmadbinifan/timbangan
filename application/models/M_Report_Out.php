<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Report_Out extends CI_Model
{
    private $table = 'tb_timbangan_dap';
    private $dsip = 'tb_timbangan_dsip';
    public function filter()
    {
        $start = $this->input->post('tgl_msk');
        $end = $this->input->post('tgl_klr');

        if ($start && $end) {
            $this->db->where('tgl_msk>=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_msk<=', date('Y-m-d', strtotime($end)));
        }
        if ($this->input->post('ctatus') == "KLR") {
            $this->db->where('ctatus', "KLR");
        } else {
            $this->db->where('ctatus', "MSK");
        }
        if ($this->input->post('no_ref')) {
            $this->db->where('no_ref', $this->input->post('no_ref'));
        }

        $this->db->select('*')
            ->from($this->table)
            ->where('no_seri');
        $data = $this->db->get()->row();
        return $data;
    }

    public function tolong($no_ref)
    {
        if ($no_ref) {
            $this->db->where('no_ref', $no_ref);
        }
        $this->db->select('*')
            ->from($this->table)
            ->where('no_ref');
        $data = $this->db->get()->result();
        return $data;
    }

    public function get($params)
    {
        return $this->db->select('nm_rls , nm_brg')->where('no_ref', $params)->get($this->table)->row();
    }

    public function filterPriode($start, $end)
    {
        $this->db->select('*')->from($this->table);
        $this->db->where('tgl_msk >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_msk <=', date('Y-m-d', strtotime($end)));
        $this->db->where('ctatus', 'KLR');
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function filterPriode_excel($start, $end)
    {
        $this->db->select('*')->from($this->table);
        $this->db->where('tgl_msk >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_msk <=', date('Y-m-d', strtotime($end)));
        $this->db->where('ctatus', 'KLR');
        $result = $this->db->get()->result();
        return $result;
    }
    public function filterPriode_excel_dsip($start, $end)
    {
        $this->db->select('*')->from($this->dsip);
        $this->db->where('tgl_msk >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_msk <=', date('Y-m-d', strtotime($end)));
        $this->db->where('ctatus', 'KLR');
        $result = $this->db->get()->result();
        return $result;
    }
    public function filterPriode_dsip($start, $end)
    {
        $this->db->select('*')->from($this->dsip);
        $this->db->where('tgl_msk >=', date('Y-m-d', strtotime($start)));
        $this->db->where('tgl_msk <=', date('Y-m-d', strtotime($end)));
        $this->db->where('ctatus', 'KLR');
        $result = $this->db->get()->result_array();
        return $result;
    }


    public function print($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_out', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_priode($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_priode_out', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_priode_dsip($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report_dsip/print_priode_out', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_dsip($fileName, $data)
    {
        $data['logo'] = $this->pdfImage();
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report_dsip/print_out', $data, TRUE);
        $this->pdf->generate($html);
    }

    public function pdfImage()
    {
        header("Content-type: application/pdf");
        // $path = base_url('assets/dist/img/kota.png');
        //isi pathnya
        $path = base_url('assets/dist/img/default/logon.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}

/* End of file M_Report.php */
