<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

	public function index()
	{
        $bulan = date('m');
        $tahun = date('Y');

        $jumlahBulan = 1;

        while ($jumlahBulan <= 12) {
            $data['bulan' . $jumlahBulan ] = $this->fungsi->jumlahPenjualan($jumlahBulan, $tahun)->num_rows();
            $data['pendapatan'. $jumlahBulan ] = $this->fungsi->pendapatanPenjualan($jumlahBulan, $tahun)->row()->pendapatan; 
            $jumlahBulan++;
        }

        $data['produkBulananTerlaris'] = $this->fungsi->produkBulananTerlaris($bulan, $tahun)->result_array();
        if (empty($data['produkBulananTerlaris'])) {
            $data['produkBulananTerlaris'] = [
                [
                    'name' => 'Tidak ada',
                    'jumlah' => '0'
                ]
            ];
        }

        $data['jumlahStokMin'] = $this->fungsi->jumlahStokMin()->result_array();

        if (empty($data['jumlahStokMin'])) {
            $data['jumlahStokMin'] = [
                [
                    'name' => 'Tidak ada',
                    'stock' => '0'
                ]
            ];
        }

        $data['title'] = 'Toko Meong';
        $data['content'] = 'dashboard';
        $data['menu'] = 'dashboard';
        $this->load->view('template', $data);
    }
    
}
 