<?php
function backView($url, $data)
{
    $ci = get_instance();
    $ci->load->view('templates/header', $data);
    $ci->load->view('templates/topbar');
    $ci->load->view('templates/sidebar');
    $ci->load->view($url);
    $ci->load->view('templates/footer');
}

function checkLogin()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('id_user'))) {
        redirect('auth');
    }
}

function adminAccess()
{
    $ci = get_instance();
    if ($ci->session->userdata('username') == "admin" || $ci->session->userdata('username') == "superuser") {
    } else {
        redirect('auth');
    }
}
function superAccess()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('username') == "superuser")) {
        redirect('auth');
    }
}
function maintenance()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('id_user'))) {
        redirect('http://dapdataserver1:8080/bakrieoleo1/dap');
    }
}
