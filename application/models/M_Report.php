<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Report extends CI_Model
{
    private $table = 'timbangan';
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

    public function pdfImage()
    {
        header("Content-type: application/pdf");
        // $path = base_url('assets/dist/img/kota.png');
        //isi pathnya
        $path = base_url('assets/dist/img/default/dap.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}

/* End of file M_Report.php */
