<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model(['item_model', 'category_model', 'unit_model']);
        is_logged_in();
    }
    
    function get_ajax() {
        $list = $this->item_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $onclick = "'Apakah anda yakin, ingin menghapus ".$item->name."'";
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->barcode.'<br><a href="'.site_url('item/barcode_qrcode/'.$item->id_item).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i> <i class="fa fa-qrcode"></i></a>';
            $row[] = $item->name;
            $row[] = $item->category_name;
            $row[] = $item->unit_name;
            $row[] = rupiah($item->price);
            $row[] = $item->stock;
            $row[] = $item->image != null ? '<img src="'.base_url('assets/image/barang/'.$item->image).'" class="img-thumbnail" style="max-height:100px">' : null;
            // Create & Update
            $row[] = '<i class="fa fa-calendar"></i> '.date('d-m-Y', strtotime($item->created)). '<br><i class="fa fa-clock-o"></i> '.date('H:i:s', strtotime($item->created));
            if($item->created != $item->updated){
                $row[] = '<i class="fa fa-calendar"></i> '.date('d-m-Y', strtotime($item->updated)). '<br><i class="fa fa-clock-o"></i> '.date('H:i:s', strtotime($item->updated));
            }else{
                $row[] = '<i class="fa fa-calendar"><i class="fa fa-clock-o">';
            }

            // add html for action
            $row[] = '<a href="'.site_url('item/edit/'.$item->id_item).'" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a><button id="hapus-item" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-hapus" data-id="'.$item->id_item.'" data-name="'.$item->name.'"><i class="fa fa-trash"></i> </button>';
           
            $data[] = $row;
        }

        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->item_model->count_all(),
                    "recordsFiltered" => $this->item_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{
            $data['title'] = 'Barang Toko Meong';
            $data['content'] = 'item/index';
            $data['menu'] = 'item';
    
            $data['item'] = $this->item_model->getAll();
    
            $this->load->view('template', $data);
    }

    public function tambah()
    {
        
        $data['title'] = 'Tambah Barang Toko Meong';
        $data['content'] = 'item/tambah';
        $data['menu'] = 'item';

        // relasi kategory dan unit
        $data['category'] = $this->category_model->getAll();
        $data['unit'] = $this->unit_model->getAll();
    
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|trim|is_unique[tb_item.barcode]');
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategory', 'required|trim');
        $this->form_validation->set_rules('unit', 'Satuan', 'required|trim');
        $this->form_validation->set_rules('price', 'Harga', 'required|trim');
        
        $this->form_validation->set_message('is_unique', '{field} sudah terpakai, silahkan ganti');
        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('template', $data);
        }else{
            $this->item_model->tambah_item();    
        }
    }
    
    public function edit($id_item)
    {
        $data['title'] = 'Edit Barang Toko Meong';
        $data['content'] = 'item/edit';
        $data['menu'] = 'item';
        
        // relasi kategory dan unit
        $data['category'] = $this->category_model->getAll();    
        $data['unit'] = $this->unit_model->getAll();  
        
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|trim');
        $this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategory', 'required|trim');
        $this->form_validation->set_rules('unit', 'Satuan', 'required|trim');
        $this->form_validation->set_rules('price', 'Harga', 'required|trim');
        
        $this->form_validation->set_message('is_unique', '{field} sudah terpakai, silahkan ganti');
        $this->form_validation->set_message('required', '{field} belum diinput');
        
        if ($this->form_validation->run() == false) {
            $data['item']  =  $this->item_model->get($id_item);    
            $this->load->view('template', $data);
        }else{
            $this->item_model->edit_item();    
        }
    }

    public function hapus()
    {
        if(!$this->input->post('id_item')){
            redirect('item');
        }
        $this->item_model->hapus_item();   
    }

    public function barcode_qrcode($id)
    {
        $data['item'] = $this->item_model->get($id);

        $data['title'] = 'BarCode QRCode Toko Meong';
        $data['content'] = 'item/barcode_qrcode';
        $data['menu'] = 'item';

        $this->load->view('template', $data);
    }

    public function barcode_print($id)
    {
        $data['item'] = $this->item_model->get($id);

         $html = $this->load->view('pdf/barcode', $data, true);

        $this->fungsi->PdfGenerator($html, 'BarCode'.$data['item']['barcode'], 'A4', 'Landscape');
    }

    public function qrcode_print($id)
    {
        $data['item'] = $this->item_model->get($id);

        $html = $this->load->view('pdf/qrcode', $data, true);

        $this->fungsi->PdfGenerator($html, 'QrCode'.$data['item']['barcode'], 'A4', 'Portrait');
    }
 
}