<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Reject_Ticket_Dsip extends CI_Model
{
    private $table = 'tb_timbangan_dsip';
    private $primary = 'no_seri';
    var $column_order = array(null, 'no_seri', 'vcf_No', 'tgl_msk', 'jam_msk', 'tgl_klr', 'jam_klr', 'no_pol', 'no_con', 'nm_rls', 'no_ref', 'nm_brg', 'brt_1', 'brt_2', 'tmb_gross_rls', 'tmb_tare_rls', 'tmb_netto_rls', 'Split_PO', 'NoPO_Split', 'Qty_PO', 'Package_Type', 'Container_Type', 'completion',  null); //set column field database for datatable orderable
    var $column_search = array('no_seri', 'vcf_No'); //set column field database for datatable searchable 
    var $order = array('no_seri' => 'Desc'); // default order 

    private function _get_datatables_query()
    {
        $start = $this->input->post('tgl_msk');
        $end = $this->input->post('tgl_klr');
        $no_ref = $this->input->post('no_ref');
        $no_ref2 = $this->input->post('no_ref2');


        if ($this->input->post('nm_rls')) {
            $this->db->where('nm_rls', $this->input->post('nm_rls'));
        }

        if ($no_ref) {
            $this->db->where('no_ref', $no_ref);
        }
        if ($no_ref2) {
            $this->db->like('no_ref', $no_ref2, 'after');
        }
        if ($this->input->post('nm_brg')) {
            $this->db->where('nm_brg', $this->input->post('nm_brg'));
        }
        if ($start && $end) {
            $this->db->where('tgl_klr>=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_klr<=', date('Y-m-d', strtotime($end)));
            // ->where($this->table['tgl_msk'] . '.tgl_msk >=', $start_date)
            // ->where($this->table['tgl_msk'] . '.tgl_msk <=', $end_date);
        }

        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->where('ctatus', "MSK");
        // $this->db->order_by('no_seri', 'DESC');
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function updateHead($id, $data)
    {
        $this->db->where($this->primary, $id);
        $res = $this->db->update($this->table, $data);
        return $res;
    }

    public function reject($id)
    {
        $data = [
            'brt_1' => 0,
            'brt_2' => 0,
            'tmb_gross_rls' => 0,
            'tmb_tare_rls' => 0,
            'tmb_netto_rls' => 0,
            'completion' => 3,
            'tgl_klr' => date('Y-m-d H:i:s'),
            'jam_klr' => date('H:i:s'),
        ];
        $res = $this->updateHead($id, $data);
        return $res;
    }
}

/* End of file M_Reject_Ticket.php */
