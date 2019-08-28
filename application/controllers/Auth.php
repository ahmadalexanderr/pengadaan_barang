<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run()==false){
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('login/index');
            $this->load->view('templates/auth_footer');            
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $validate = $this->Login_model->validate($username,$password);
        if($validate->num_rows() > 0){
            $data = $validate->row_array();
            $username = $data['username'];
            $level = $data['level'];
            $sesdata = array(
                'username'  => $username,
                'level'     => $level,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sesdata);
            if($level === 'admin'){
                redirect('admin');
            } elseif ($level === 'user'){
                redirect('user');
            } else {
                redirect('subag');
            }
        } else {
            $this->session->set_flashdata('flash',  '<div class="alert alert-warning" role="alert">  Silahkan periksa username atau password Anda </div>');
            redirect('auth/index');
        }
    }
    
    public function logout()
    {
        $data['title'] = 'Logout Modal';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/footer');
        $this->session->sess_destroy();
        redirect('auth/index');
    }

    public function forgot()
    {
        $this->load->view('login/forgot');
    }

    public function blocked()
    {
        $data['title'] = 'Halaman 403';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('login/blocked', $data);
        $this->load->view('templates/footer');
    }
}
