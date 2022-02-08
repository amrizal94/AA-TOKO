<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('supplier_model');
        is_logged_in();
    }

	public function index()
	{
        $data['title'] = 'Pemasok - Toko Meong';
        $data['content'] = 'supplier/index';
        $data['menu'] = 'suppliers';

        
        $data['supplier'] = $this->supplier_model->getAll();

        $this->load->view('template', $data);
    }
    
    public function tambah()
    {
        
        $data['title'] = 'Tambah Pemasok - Toko Meong';
        $data['content'] = 'supplier/tambah';
        $data['menu'] = 'supplier';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        $this->form_validation->set_rules('phone', 'No Telepon', 'required|trim');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');

        
        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->supplier_model->tambah_supplier();   
        }

    }
    
    public function hapus()
    {
        if(!$this->input->post('id_supplier')){
            redirect('supplier');
        }
        $this->supplier_model->hapus_supplier();   
    }

    
    public function edit($id_supplier)
    {
        $data['title'] = 'Edit Pemasok - Toko Meong';
        $data['content'] = 'supplier/edit';
        $data['menu'] = 'supplier';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        $this->form_validation->set_rules('phone', 'No Telepon', 'required|trim');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim');

        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $data['supplier']  =  $this->supplier_model->get($id_supplier);    
            $this->load->view('template', $data);
        }else{
            $this->supplier_model->edit_supplier();    
        }
    }
}
 