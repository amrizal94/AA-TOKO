<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('unit_model');
        is_logged_in();
    }

	public function index()
	{
            $data['title'] = 'Unit Toko Meong';
            $data['content'] = 'unit/index';
            $data['menu'] = 'unit';
    
            $data['unit'] = $this->unit_model->getAll();
    
            $this->load->view('template', $data);
    }

    public function tambah()
    {
        
        $data['title'] = 'Tambah Unit Toko Meong';
        $data['content'] = 'unit/tambah';
        $data['menu'] = 'unit';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');

        
        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->unit_model->tambah_unit();    
        }

    }
    
    
    public function edit($id_unit)
    {
        $data['title'] = 'Edit Unit Toko Meong';
        $data['content'] = 'unit/edit';
        $data['menu'] = 'unit';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $data['unit']  =  $this->unit_model->get($id_unit);    
            $this->load->view('template', $data);
        }else{
            $this->unit_model->edit_unit();    
        }
    }

    public function hapus()
    {
        if(!$this->input->post('id_unit')){
            redirect('unit');
        }
        $this->unit_model->hapus_unit();   
    }

}