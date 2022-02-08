<?php

use PhpParser\Node\Expr\New_;

defined('BASEPATH') OR exit('No direct script access allowed');

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class Sale extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model(['sale_model', 'customer_model', 'item_model']);
        is_logged_in();
    }

    public function index()
    {
            $data['title'] = 'Kasir Toko Meong';
            $data['content'] = 'sale/index';
            $data['menu'] = 'sale';
    
            $data['customer'] = $this->customer_model->getAll();

            // $initials_invoice = setting_shop()['initials_invoice'];
           
            $data['invoice'] = $this->sale_model->invoice_no();
  
            $data['item'] = $this->item_model->getAll();
            $data['cart'] = $this->sale_model->get_cart();
            
            $this->load->view('template', $data);
    }

    public function cart_data()
    {
            $data['cart'] = $this->sale_model->get_cart();
            $this->load->view('sale/cart_data', $data);
    }

    public function process()
    {
        $data = $this->input->post(null, TRUE);

        if(isset($_POST['add_cart'])){
            $id_item = $this->input->post('id_item');
            $check_cart = $this->sale_model->get_cart(['tb_cart.id_item' => $id_item]);
            if($check_cart->num_rows() > 0){
                $this->sale_model->update_cart_qty($data);
            }else{
                $this->sale_model->add_cart($data);
            }
    
            if($this->db->affected_rows() > 0){
                $params = [
                    "success" => true
                ];
            }else{
                $params = [
                    "success" => false
                ];
            }
            
            echo json_encode($params);
        }

        if(isset($_POST['edit_cart'])){

            $this->sale_model->edit_cart($data);
            
            if($this->db->affected_rows() > 0){
                $params = [
                    "success" => true
                ];
            }else{
                $params = [
                    "success" => false
                ];
            }
            
            echo json_encode($params);
        }

        if(isset($_POST['process-payment'])){
            
            $id_sale = $this->sale_model->add_sale($data);
            $cart = $this->sale_model->get_cart()->result();
            $row = [];
            foreach ($cart as $c => $value ) {
                array_push($row, array(
                    'id_sale' => $id_sale,
                    'id_item' => $value->id_item,
                    'price' => $value->price,
                    'qty' => $value->qty,
                    'discount_item' => $value->discount_item,
                    'total' => $value->total,
                )
                );
            }

            $this->sale_model->add_sale_detail($row);
            $this->sale_model->del_cart(['id_user' => $this->session->userdata('id_user')]);

            if($this->db->affected_rows() > 0){
                $params = [
                    "success" => true,
                    "id_sale" => $id_sale
                ];
            }else{
                $params = [
                    "success" => false
                ];
            }

            // $data = [
            //     'setting_shop' => setting_shop()
            // ];

            // $connector = New Escpos\PrintConnectors\WindowsPrintConnector('printer_ci');
            // $printer = New Escpos\Printer($connector);

            // // Teks rata tengah JUSTIFY_CENTER
            // $printer->initialize();
            // $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            // $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_WIDTH);
            // $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            // $printer->text($data['setting_shop']['shop_name']);
            // $printer->text("\n");

            // $printer->initialize();
            // $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            // $printer->text($data['setting_shop']['address']);
            // $printer->text("\n");
            // $printer->text($data['setting_shop']['telp']);
            // $printer->text("\n");

            

            // $printer->close();

            
            echo json_encode($params);

        }

    } 


    
    public function cart_del()
    {
        if(isset($_POST['cancel_payment'])){
            $this->sale_model->del_cart(['id_user' => $this->session->userdata('id_user')]);
        } else {
            $id_cart = $this->input->post('id_cart');
            $this->sale_model->del_cart(['id_cart' => $id_cart]);
        }   

 
        
        if($this->db->affected_rows() > 0){
            $params = [
                "success" => true 
            ];
        }else{
            $params = [
                "success" => false
            ];
        }
        
        echo json_encode($params);
    }

    public function cetak($id)
    {

        $data = [
            'sale' => $this->sale_model->getSale($id)->row(),
            'sale_detail' => $this->sale_model->getSaleDetail($id)->result(),
            'sale_detail_jml' => $this->sale_model->getSaleDetail($id)->num_rows(),
            'sale_detail_discount' => $this->sale_model->getSaleDetail($id, "0")->num_rows(),
            'setting_shop' => setting_shop()
        ];

        
        if($data['sale_detail_jml'] == $data['sale_detail_discount'] ){
            $data['disc_jml'] = "tidak ada";
        }else{
            $data['disc_jml'] = "ada"; 
        }

        $this->load->view('sale/receipt_print', $data);
        $this->_cetak($data);
    }

    private function _cetak($d) {

        function buatBaris1Kolom($kolom1)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 33;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = count($kolom1Array);

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode("\n", $hasilBaris) . "\n";
        }

        function buatBaris3Kolom($kolom1, $kolom2, $kolom3)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 11;
            $lebar_kolom_2 = 11;
            $lebar_kolom_3 = 11;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_LEFT);

                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode("\n", $hasilBaris) . "\n";
        }

        $data = $d;
        $profile = CapabilityProfile::load("simple");
        $connector = new WindowsPrintConnector("printer_ci");
        $printer = new Printer($connector, $profile);

        $printer->initialize();
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text(buatBaris1Kolom($data['setting_shop']['shop_name']));

        $printer->initialize();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->text(buatBaris1Kolom($data['setting_shop']['address']));
        $printer->text(buatBaris1Kolom($data['setting_shop']['telp']));
        
        $printer->initialize();
        $printer->selectPrintMode(Printer::MODE_FONT_B);
        $printer->text(buatBaris1Kolom("---------------------------------"));

        $printer->text(buatBaris3Kolom(date('d/m/Y', strtotime($data['sale']->date)), "Kasir : ", $data['sale']->user_name));
        $printer->text(buatBaris3Kolom($data['sale']->invoice, "Pelanggan : ", $data['sale']->id_customer == null? "Umum" : ucfirst($data['sale']->customer_name)));
        foreach ($data['sale_detail'] as $key => $value) {
            $printer->text(buatBaris1Kolom($value->name));
            $printer->text(buatBaris3Kolom(number_format($value->qty, 0), rupiah($value->price) . $value->discount_item > 0 ? rupiah($value->discount_item) : "", rupiah(($value->price - $value->discount_item) * $value->qty)));
        }
        $printer->text(buatBaris1Kolom("---------------------------------"));

        if($data['disc_jml'] == "tidak ada" && $data['sale']->discount != 0){

        }if($data['sale']->discount > 0) {
            $printer->text(buatBaris3Kolom("","Total Harga", rupiah($data['sale']->total_price)));
            $printer->text(buatBaris3Kolom("","Diskon", rupiah($data['sale']->discount)));
        }

        $printer->text(buatBaris3Kolom("","Total Bayar", rupiah($data['sale']->final_price)));
        $printer->text(buatBaris3Kolom("","Tunai", rupiah($data['sale']->cash)));
        $printer->text(buatBaris3Kolom("","Kembalian", rupiah($data['sale']->remaining)));
        $printer->text("\n");

        $printer->initialize();
        $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text(buatBaris1Kolom("Terima Kasih, Selamat belanja kembali."));
    }
} 