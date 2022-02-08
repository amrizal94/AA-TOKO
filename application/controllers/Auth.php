<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
        sudah_login();
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username belum diinput',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password belum diinput',
        ]);
 
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Toko Meong';
            $data['setting'] = setting_shop();
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
	}

	private function _login()
    {
        
        $this->load->model('user_model');

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->user_model->login($username);

        if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'id_user' =>  $user['id_user'],
					'username' =>  $user['username'],
					'level' =>  $user['level']
				];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Selamat datang diaplikasi POINT OF SALE</p></div>');
                redirect('dashboard');
			} else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-ban"></i> Password Salah!</p></div>');
                redirect('auth');
			}
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-ban"></i> User tidak ada!</p></div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        // menghapus session
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Anda berhasil keluar!</p></div>');
        redirect('auth');
    }
            

}
 