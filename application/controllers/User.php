<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_admin();
        $this->load->model('user_model');
    }

	public function index() 
	{ 
        $data['title'] = 'User Toko Meong';
        $data['content'] = 'user/index';
        $data['menu'] = 'user';
        $data['users'] = $this->user_model->getAll();
        
        $this->load->view('template', $data);
    }
    
    public function tambah()
    {
        
        $data['title'] = 'Tambah user Toko Meong';
        $data['content'] = 'user/tambah';
        $data['menu'] = 'user';
        
        $this->form_validation->set_rules('fullname', 'fullname', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_users.username]');
        $this->form_validation->set_rules('sex', 'sex', 'required|trim');
        $this->form_validation->set_rules('address', 'address', 'required|trim');
        $this->form_validation->set_rules('level', 'level', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password]');

        
        $this->form_validation->set_message('required', '{field} belum diinput');
        $this->form_validation->set_message('matches', '{field} Tidak cocok');
        $this->form_validation->set_message('is_unique', '{field} sudah terpakai, silahkan ganti');
        $this->form_validation->set_message('min_length', '{field} harus 5 karakter atau lebih');

        
        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->user_model->tambah_user();   
        }

    }

    public function hapus()
    {
        if(!$this->input->post('id_user')){
            redirect('user');
        }
        $this->user_model->hapus_user();   
    }

    public function edit($id_user)
    {
        $data['title'] = 'Edit user Toko Meong';
        $data['content'] = 'user/edit';
        $data['menu'] = 'user';
        
        $this->form_validation->set_rules('fullname', 'fullname', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_username_check');
        $this->form_validation->set_rules('sex', 'sex', 'required|trim');
        $this->form_validation->set_rules('address', 'address', 'required|trim');
        $this->form_validation->set_rules('level', 'level', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|matches[password]');

        $this->form_validation->set_message('required', '{field} belum diinput');
        $this->form_validation->set_message('matches', '{field} Tidak cocok');
        $this->form_validation->set_message('is_unique', '{field} sudah terpakai, silahkan ganti');
        $this->form_validation->set_message('min_length', '{field} minimal 6 karakter');
        
        if ($this->form_validation->run() == false) {
            $data['user']  =  $this->user_model->get($id_user);    
            $this->load->view('template', $data);
        }else{
            $this->user_model->edit_user();    
        }
    }

    function username_check()
    {   
        $post = $this->input->post(null, TRUE);

        $query = $this->db->query("SELECT * FROM tb_users WHERE username = '$post[username]' AND id_user !='$post[id_user]' ");

        if($query->num_rows() > 0){
            $this->form_validation->set_message('username_check', '{field} sudah terpakai, silahkan ganti');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function setting() 
	{ 
        $data['title'] = 'Pengaturan Toko Meong';
        $data['content'] = 'user/setting';
        $data['menu'] = 'setting';
        $data['setting'] = setting_shop();
        
        
        $this->form_validation->set_rules('shop_name', 'Nama Toko', 'required|trim');
        $this->form_validation->set_rules('shop_owner', 'Pemilik Toko', 'required|trim');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telp', 'No Telp.', 'required|trim|max_length[16]');
        $this->form_validation->set_rules('initials_invoice', 'Inisial Struk', 'required|trim|min_length[2]|max_length[2]');

        $this->form_validation->set_message('required', '{field} belum diinput');
        $this->form_validation->set_message('min_length', '{field} harus 2 karakter');
        $this->form_validation->set_message('max_length', '{field} melebihi batas karakter');


        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->user_model->edit_setting();    
        }
    }
}
 