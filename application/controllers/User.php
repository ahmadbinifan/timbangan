<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('M_User', 'user');
    }

    public function index()
    {
        superAccess();
        $data['title'] = 'User';
        // $data['position'] = $this->position->getList();
        // $data['division'] = $this->division->getList();
        backView('user/index', $data);
    }
    public function list_user()
    {
        $list = $this->user->get_datatables();
        $data_user = array();
        $no = $_POST['start'];

        foreach ($list as $value) {
            // if ($value->user_status == 0) {
            //     $user_status = "<div class='badge badge-primary'>Admin</div>";
            // } elseif ($value->user_status == 1) {
            //     $user_status = "<div class='badge badge-success'>Super Admin</div>";
            // } elseif ($value->user_status == 2) {
            //     $user_status = "<div class='badge badge-warning'>Unique Access</div>";
            // }
            if ($value->pdf == 0) {
                $pdf = "<div class='badge badge-danger'><i class='fas fa-times-circle'></i></div>";
            } elseif ($value->pdf == 1) {
                $pdf = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->excel == 0) {
                $excel = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->excel == 1) {
                $excel = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->periode == 0) {
                $periode = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->periode == 1) {
                $periode = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->dap == 0) {
                $dap = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->dap == 1) {
                $dap = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->dsip == 0) {
                $dsip = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->dsip == 1) {
                $dsip = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->penerimaan == 0) {
                $penerimaan = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->penerimaan == 1) {
                $penerimaan = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->pengeluaran == 0) {
                $pengeluaran = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->pengeluaran == 1) {
                $pengeluaran = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }
            if ($value->reject == 0) {
                $reject = "<div class='badge badge-danger'><i class='fas fa-times-circle'></div>";
            } elseif ($value->reject == 1) {
                $reject = "<div class='badge badge-success'><i class='fas fa-check-circle'></i></div>";
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->fullname;
            $row[] = $value->username;
            $row[] = $value->section;
            $row[] = $pdf;
            $row[] = $excel;
            $row[] = $periode;
            $row[] = $dap;
            $row[] = $dsip;
            $row[] = $penerimaan;
            $row[] = $pengeluaran;
            $row[] = $reject;
            $row[] = "
            <div class='row'>
                <button type='button' class='btn btn-success btn-sm' onclick='get(" . "\"" . $value->id_user . "\")' data-toggle='modal' data-target='#modalEdit' data-backdrop='static' data-keyboard='false' >
                <i class='fas fa-eye fa-xs'></i>
                </button>
                <button type='button' class='btn btn-danger btn-sm' onclick='remove(" . "\"" . $value->id_user . "\")' >
                    <i class='fas fa-trash fa-xs'></i>
                </button>
            </div>";
            $data_user[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data_user,
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
        );
        echo json_encode($output);
    }

    public function get()
    {
        $id = $this->input->post('id');
        $data = $this->user->get($id);
        echo json_encode($data);
    }

    public function getList()
    {
        $data = $this->user->getList();
        echo json_encode($data);
    }
    public function create()
    {
        superAccess();
        $data = $this->input->post();
        $data['id_user'] = time();
        $confirm = $this->user->exist($data);
        if ($confirm == true) {
            $data['password'] = md5($data['password']);
            $this->user->create($data);
        }
        echo json_encode($confirm);
    }
    public function remove()
    {
        superAccess();
        $id = $this->input->post('id');
        $res = $this->user->delete($id);
        echo json_encode($res);
    }
    public function update()
    {
        superAccess();
        $id = $this->input->post('id_user');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data = $this->input->post();
        $id = $data['id_user'];
        unset($data['id_user']);
        // $data['password'] = md5($data['password']);
        $res = $this->user->update($id, $data);
        echo json_encode($res);
    }
}
