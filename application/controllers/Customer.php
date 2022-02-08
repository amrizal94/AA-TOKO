<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        is_logged_in();
    }

	public function index()
	{
        $data['title'] = 'Pelanggan - Toko Meong';
        $data['content'] = 'customer/index';
        $data['menu'] = 'customers';

        
        $data['customer'] = $this->customer_model->getAll();

        $this->load->view('template', $data);
    }
    
    public function tambah()
    {
        
        $data['title'] = 'Tambah Pelanggan - Toko Meong';
        $data['content'] = 'customer/tambah';
        $data['menu'] = 'customer';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        $this->form_validation->set_rules('phone', 'No Telepon', 'required|trim');
        $this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');

        
        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->customer_model->tambah_customer();   
        }

    }
    
    public function hapus()
    {
        if(!$this->input->post('id_customer')){
            redirect('customer');
        }
        $this->customer_model->hapus_customer();   
    }

    
    public function edit($id_customer)
    {
        $data['title'] = 'Edit Pelanggan - Toko Meong';
        $data['content'] = 'customer/edit';
        $data['menu'] = 'customer';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        $this->form_validation->set_rules('phone', 'No Telepon', 'required|trim');
        $this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|trim');

        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $data['customer']  =  $this->customer_model->get($id_customer);    
            $this->load->view('template', $data);
        }else{
            $this->customer_model->edit_customer();    
        }
    }
}
 