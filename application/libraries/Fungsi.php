<?php 


Class Fungsi {

    public function __construct()

    {

        $ci =& get_instance();

        $ci->load->model(['user_model', 'item_model', 'supplier_model', 'customer_model','sale_model']);

    }

    

    public function user_login()

    {

        $ci =& get_instance();

        $id_user = $ci->session->userdata('id_user');

        return $ci->user_model->get($id_user);

    }



    public function setting_shop()

    {

        $ci =& get_instance();

        return $ci->db->get('tb_setting')->row_array();

    }



    public function PdfGenerator($html, $filename, $paper, $orientation)

    {

        // instantiate and use the dompdf class

        $dompdf = new Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation

        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF

        $dompdf->render();

        // Output the generated PDF to Browser

        $dompdf->stream($filename, array('Attachment' => 0));

    }



    public function count_item()

    {

        $ci =& get_instance();

        return $ci->item_model->getSemua()->num_rows();

    }



    public function count_supplier()

    {

        $ci =& get_instance();

        return $ci->supplier_model->getSemua()->num_rows();

    }



    public function count_customer()

    {

        $ci =& get_instance();

        return $ci->customer_model->getSemua()->num_rows();

    }



    public function count_user()

    {

        $ci =& get_instance();

        return $ci->user_model->getSemua()->num_rows();

    }



    

    public function jumlahPenjualan($bulan = null, $tahun = null)

    {

        $ci =& get_instance();

        return $ci->sale_model->jumlahPenjualan($bulan, $tahun);

    }



    public function pendapatanPenjualan($bulan = null, $tahun = null)

    {

        $ci =& get_instance();

        return $ci->sale_model->pendapatanPenjualan($bulan, $tahun);

    }



    public function produkBulananTerlaris($bulan = null, $tahun = null)

    { 

        $ci =& get_instance();

        return $ci->sale_model->produkBulananTerlaris($bulan, $tahun);

    }



    public function jumlahStokMin()

    {

        $ci =& get_instance();

        return $ci->item_model->getStockMin();

    }



}