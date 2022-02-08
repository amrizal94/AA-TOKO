<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model(['report_model', 'customer_model', 'sale_model', 'supplier_model']);
        is_logged_in();
    }

	public function index()
	{
        $data['title'] = 'Laporan Toko Meong';
        $data['content'] = 'report/index';
        $data['menu'] = 'sales';

        $data['tanggal'] = null;
        $data['sd'] = null;
        $data['pelanggan'] = null;
        $data['invoice'] = null;

        if($this->input->post('filter') == "filter" || $this->input->post('filter') == "print"){
            if ($this->input->post('tanggal')) {
                $data['tanggal'] = $this->input->post('tanggal');
            }
            if ($this->input->post('sd')) {
                $data['sd'] = $this->input->post('sd');
            }
            if ($this->input->post('pelanggan')) {
                $data['pelanggan'] = $this->input->post('pelanggan');
            }
            if ($this->input->post('invoice')) {
                $data['invoice'] = $this->input->post('invoice');
            }
        }
        
        $data['report'] = $this->report_model->getSaleBy($data['tanggal'], $data['sd'], $data['pelanggan'], $data['invoice'])->result_array();

        if ($this->input->post('filter') == "print") {
            $dataPrint['report'] = $data['report'];
            if ($this->input->post('tanggal') && $this->input->post('sd')) {
                if ($this->input->post('tanggal') === $this->input->post('sd')) {
                    $dataPrint['lap'] = "Laporan Penjualan (". date('d-m-Y', strtotime($this->input->post('tanggal'))) .")";
                }else{
                    $dataPrint['lap'] = "Laporan Penjualan (". date('d-m-Y', strtotime($this->input->post('tanggal'))) . " s/d " . date('d-m-Y', strtotime($this->input->post('sd'))) .")";
                }
            }else{
                $dataPrint['lap'] = "Laporan Penjualan (Semua Penjualan)";
            }
            if ($this->input->post('pelanggan')) {
                $dataPrint['pelanggan'] = $this->input->post('pelanggan');
            }else{
                $dataPrint['pelanggan'] = "";
            }

            $dataPrint['setting'] = setting_shop();
            $html = $this->load->view('pdf/sale', $dataPrint, true);
            $this->fungsi->PdfGenerator($html, 'Sale', 'A4', 'Portrait');
            die;
        }

        $data['customer'] = $this->customer_model->getAll();
        $data['sale'] = $this->sale_model->getSale()->result_array();

        $this->load->view('template', $data);
    }

    public function sale_product($sale_id = null)
    {
        $detail = $this->report_model->getSaleDetail($sale_id)->result();
        echo json_encode($detail);
    }

    public function hapus()
    {
        if(!$this->input->post('id_sale')){
            redirect('report');
        }
        $this->report_model->hapus_sale();   
    }

    public function stock()
	{
        $data['title'] = 'Laporan Toko Meong';
        $data['content'] = 'report/stock';
        $data['menu'] = 'stocks';

        $data['tanggal'] = null;
        $data['sd'] = null;
        $data['type'] = null;
        $data['pemasok'] = null;
        
         if($this->input->post('filter') == "filter" || $this->input->post('filter') == "print"){
            if ($this->input->post('tanggal')) {
                $data['tanggal'] = $this->input->post('tanggal');
            }
            if ($this->input->post('sd')) {
                $data['sd'] = $this->input->post('sd');
            } 
            if ($this->input->post('type')) {
                $data['type'] = $this->input->post('type');
            }
            if ($this->input->post('pemasok')) {
                $data['pemasok'] = $this->input->post('pemasok');
            }
        }
        

 
        $data['report'] = $this->report_model->getStockBy($data['tanggal'], $data['sd'], $data['type'], $data['pemasok'])->result_array();
        
        if ($this->input->post('filter') == "print") {
            $dataPrint['report'] = $data['report'];
            if ($this->input->post('tanggal') && $this->input->post('sd')) {
                if ($this->input->post('tanggal') === $this->input->post('sd')) {
                    $dataPrint['lap'] = "Laporan stok (". date('d-m-Y', strtotime($this->input->post('tanggal'))) .")";
                }else{
                    $dataPrint['lap'] = "Laporan stok (". date('d-m-Y', strtotime($this->input->post('tanggal'))) . " s/d " . date('d-m-Y', strtotime($this->input->post('sd'))) .")";
                }
            }else{
                $dataPrint['lap'] = "Laporan stok (Semua stok)";
            }
            if ($this->input->post('pemasok')) {
                $dataPrint['pemasok'] = $this->input->post('pemasok');
            }else{
                $dataPrint['pemasok'] = "";
            }
            $dataPrint['setting'] = setting_shop();
            $html = $this->load->view('pdf/stock', $dataPrint, true);
            $this->fungsi->PdfGenerator($html, 'Stock', 'A4', 'Landscape');
            die;
        }

        $data['pemasok2'] = $this->supplier_model->getAll();

        $this->load->view('template', $data);
    }
    
}
  