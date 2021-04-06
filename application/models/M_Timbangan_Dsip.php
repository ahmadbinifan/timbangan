<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Timbangan_Dsip extends CI_Model
{
    private $table = 'timbangan_dsip';
    private $primary = 'no_seri';
    var $column_order = array(null, 'no_seri', 'tgl_msk', 'jam_msk', 'tgl_klr', 'jam_klr', 'no_pol', 'no_con', 'nm_rls', 'no_ref', 'nm_brg', 'brt_1', 'brt_2', 'tmb_rls'); //set column field database for datatable orderable
    var $column_search = array('no_seri', 'nm_brg', 'no_ref'); //set column field database for datatable searchable 
    var $order = array('no_seri' => 'Desc'); // default order 

    private function _get_datatables_query()
    {
        $start = $this->input->post('tgl_msk');
        $end = $this->input->post('tgl_klr');

        if ($this->input->post('nm_rls')) {
            $this->db->where('nm_rls', $this->input->post('nm_rls'));
        }
        if ($this->input->post('no_ref')) {
            $this->db->where('no_ref', $this->input->post('no_ref'));
        }
        if ($this->input->post('nm_brg')) {
            $this->db->where('nm_brg', $this->input->post('nm_brg'));
        }
        if ($start && $end) {
            $this->db->where('tgl_msk>=', date('Y-m-d', strtotime($start)));
            $this->db->where('tgl_msk<=', date('Y-m-d', strtotime($end)));
            // ->where($this->table['tgl_msk'] . '.tgl_msk >=', $start_date)
            // ->where($this->table['tgl_msk'] . '.tgl_msk <=', $end_date);
        }

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('ctatus', "MSK");
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

    public function get_noRef()
    {
        $this->db->distinct();
        $this->db->select('no_ref')->from($this->table)->order_by('no_ref', 'asc')->where('ctatus', "MSK");
        $query = $this->db->get();
        $return = $query->result();
        return $return;
    }

    public function get_rls($params)
    {
        return $this->db->select('nm_rls , nm_brg')->where('no_ref', $params)->get($this->table)->row();
    }

    public function get_barang()
    {
        $this->db->distinct();
        $this->db->select('nm_brg')->from($this->table)->order_by('nm_brg', 'asc')->where('ctatus', "MSK");
        $query = $this->db->get();
        $return = $query->result();
        return $return;
    }

    public function rangeDate($start_date, $end_date)
    {
        $this->db->select($this->table)
            ->where($this->table['tgl_msk'] . '.tgl_msk >=', $start_date)
            ->where($this->table['tgl_msk'] . '.tgl_msk <=', $end_date);
        $query = $this->db->get();
        $return = $query->result();
        return $return;
    }

    public function statistic()
    {
        $data = [
            'all' => $this->db->get($this->table)->num_rows(),
            'MSK' => $this->countStatus('MSK'),
            'KLR' => $this->countStatus('KLR'),
            'success' => $this->countCompletion('1'),
            'unsuccess' => $this->countCompletion('2'),
            // 'success' => $this->countStatus('SUCCESS')
        ];
        return $data;
    }

    public function countStatus($status)
    {
        $this->db->like('ctatus', $status);

        $num = $this->db->get($this->table)->num_rows();
        return $num;
    }
    public function countCompletion($completion)
    {
        $this->db->like('completion', $completion);

        $num = $this->db->get($this->table)->num_rows();
        return $num;
    }
}
