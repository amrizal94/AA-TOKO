<?php


function is_logged_in()

{

    $ci = get_instance();



    if (!$ci->session->userdata('id_user')) {

        $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-ban"></i> Harap login terlebih dahulu!</p></div>');

        redirect('auth');

    } 

}



function sudah_login()

{

    $ci = get_instance();



    if ($ci->session->userdata('id_user')) {

    $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-ban"></i> Harap logout terlebih dahulu!</p></div>');

    redirect('dashboard');

    }

}





function check_admin()

{

    $ci =& get_instance();

    $ci->load->library('fungsi');

    if($ci->fungsi->user_login()['level'] != 1){

    $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-ban"></i> Akses ditolak!</p></div>');

    redirect('dashboard');

    }

}



function rupiah($angka){

	

	$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');

	return $hasil_rupiah;

}



function setting_shop()

{

    $ci =& get_instance();

    $ci->load->library('fungsi');

    return $ci->fungsi->setting_shop();

}

