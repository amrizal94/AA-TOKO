<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        is_logged_in();
    }

	public function index()
	{
            $data['title'] = 'Kategori - Toko Meong';
            $data['content'] = 'category/index';
            $data['menu'] = 'category';
    
            $data['category'] = $this->category_model->getAll();
    
            $this->load->view('template', $data);
    }

    public function tambah()
    {
        
        $data['title'] = 'Tambah Kategori - Toko Meong';
        $data['content'] = 'category/tambah';
        $data['menu'] = 'category';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->category_model->tambah_category();    
        }

    }
    
    
    public function edit($id_category)
    {
        $data['title'] = 'Edit Kategori - Toko Meong';
        $data['content'] = 'category/edit';
        $data['menu'] = 'category';
        
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $data['category']  =  $this->category_model->get($id_category);    
            $this->load->view('template', $data);
        }else{
            $this->category_model->edit_category();    
        }
    }

    public function hapus()
    {
        if(!$this->input->post('id_category')){
            redirect('category');
        }
        $this->category_model->hapus_category();   
    }

}