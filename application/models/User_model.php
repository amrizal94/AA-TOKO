<?php
class User_model extends CI_Model
{

//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    public function get($id = null)
    {
        if ($id != null) {
            $this->db->where('id_user', $id);
        }

        return $this->db->get('tb_users')->row_array();
    }

    public function login($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_users')->row_array();
    }

    public function getAll()
    {
        $this->db->ORDER_BY('level', 'ASC');
        return $this->db->get('tb_users')->result_array();
    } 

    public function getSemua()
    {
        $this->db->ORDER_BY('level', 'ASC');
        return $this->db->get('tb_users');
    } 

    public function tambah_user()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'username' => htmlspecialchars($this->input->post('username')),
            'sex' => htmlspecialchars($this->input->post('sex')),
            'level' => htmlspecialchars($this->input->post('level')),
            'address' => htmlspecialchars(htmlspecialchars($this->input->post('address'))),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image' => 'default.png'
        ];
        $this->db->insert('tb_users', $data);


        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('user');
    }
    
    public function edit_user()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'username' => htmlspecialchars($this->input->post('username')),
            'sex' => htmlspecialchars($this->input->post('sex')),
            'level' => htmlspecialchars($this->input->post('level')),
            'address' => htmlspecialchars(htmlspecialchars($this->input->post('address')))
        ];
        
        if($this->input->post('password')){
            $this->db->set('password' , password_hash($this->input->post('password'), PASSWORD_DEFAULT));
        }

        $this->db->where('id_user' , htmlspecialchars($this->input->post('id_user')));
        $this->db->update('tb_users', $data);


        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil diubah</p></div>');
        redirect('user');
    }

    public function edit_setting()
    {
         $data = [
            'shop_name' => htmlspecialchars($this->input->post('shop_name')),
            'shop_owner' => htmlspecialchars($this->input->post('shop_owner')),
            'telp' => htmlspecialchars($this->input->post('telp')),
            'address' => htmlspecialchars($this->input->post('address')),
            'initials_invoice' => htmlspecialchars(htmlspecialchars($this->input->post('initials_invoice')))
        ];

        $this->db->where('id_setting' , htmlspecialchars($this->input->post('id_setting')));
        $this->db->update('tb_setting', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil diubah</p></div>');
        redirect('user/setting');
    }

    public function hapus_user()
    {
        $id = $this->input->post('id_user');
        
        $this->db->where('id_user', $id);
        $this->db->delete('tb_users');

        $error = $this->db->error();
        if($error['code'] != 0){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-times"></i> Data tidak bisa dihapus! (sudah berelasi)</p></div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        }
        redirect('user');

    }

}
