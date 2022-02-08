<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['item_model', 'category_model', 'unit_model', 'supplier_model', 'stock_model']);
        is_logged_in();
    }

	public function stock_in_data()
	{
        $data['title'] = 'Stock in Toko Meong';
        $data['content'] = 'transaction/stock_in/stock_in_data';
        $data['menu'] = 'stock in';

        
        $data['stock'] = $this->stock_model->getAllStockIn()->result_array();
        
        $this->load->view('template', $data);
    }
    
	public function stock_in_add()
	{
        $data['title'] = 'Tambah Stock in Toko Meong';
        $data['content'] = 'transaction/stock_in/stock_in_add';
        $data['menu'] = 'tambah stock in';

        $data['item'] = $this->item_model->getAll();
        $data['supplier'] = $this->supplier_model->getAll();

        $data['stock'] = $this->stock_model->getAllStockIn()->result_array();
        
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|trim');
        $this->form_validation->set_rules('name_item', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('name_unit', 'Satuan', 'required|trim');
        $this->form_validation->set_rules('stok_awal', 'Stok Awal', 'required|trim');
        $this->form_validation->set_rules('detail', 'Detail', 'required|trim');
        $this->form_validation->set_rules('purchase_price', 'Harga Beli', 'required|trim');
        $this->form_validation->set_rules('total_price', 'Total Harga', 'required|trim');
        $this->form_validation->set_rules('qty', 'Qty', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');

        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->item_model->update_stock_in();     
            $this->stock_model->tambah_stock_in();     
        }
    }

    public function hapus_stock_in()
    {
        if(!$this->input->post('id_stock')){
            redirect('stock/in');
        }
        $this->item_model->downdate_stock_in();  
        $this->stock_model->hapus_stock_in(); 
    }

    
	public function stock_out_data()
	{
        $data['title'] = 'Stock out Toko Meong';
        $data['content'] = 'transaction/stock_out/stock_out_data';
        $data['menu'] = 'stock out';

        
        $data['stock'] = $this->stock_model->getAllStockOut()->result_array();
        
        $this->load->view('template', $data);
    }
    
	public function stock_out_add()
	{
        $data['title'] = 'Tambah Stock Toko Meong';
        $data['content'] = 'transaction/stock_out/stock_out_add';
        $data['menu'] = 'tambah stock out';

        $data['item'] = $this->item_model->getAll();
        $data['supplier'] = $this->supplier_model->getAll();

        $data['stock'] = $this->stock_model->getAllStockOut()->result_array();
        
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|trim');
        $this->form_validation->set_rules('name_item', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('name_unit', 'Satuan', 'required|trim');
        $this->form_validation->set_rules('stok_awal', 'Stok Awal', 'required|trim');
        $this->form_validation->set_rules('detail', 'Detail', 'required|trim');
        $this->form_validation->set_rules('qty', 'Qty', 'required|trim');
        
        $this->form_validation->set_message('required', '{field} belum diinput');

        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{ 
            $cek_stock = $this->item_model->get($this->input->post('id_item'))['stock'];
            if ($this->input->post('qty') > $cek_stock) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Jumlah melebihi stok barang</p></div>');
                 redirect('stock/out/tambah');
            }
            $this->item_model->update_stock_out();     
            $this->stock_model->tambah_stock_out();     
        }
    }

    public function hapus_stock_out()
    {
        if(!$this->input->post('id_stock')){
            redirect('stock/in');
        }
        $this->item_model->downdate_stock_out();  

        $this->stock_model->hapus_stock_out();  
    }
 
}