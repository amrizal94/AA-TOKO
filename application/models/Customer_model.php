<?php
class Customer_model extends CI_Model
{

//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    public function get($id = null)
    {
        if ($id != null) {
            $this->db->where('id_customer', $id);
        }

        return $this->db->get('tb_customer')->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_customer')->result_array();
    } 

    public function getSemua()
    {
        return $this->db->get('tb_customer');
    } 

    public function tambah_customer()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'phone' => htmlspecialchars($this->input->post('phone')),
            'address' => htmlspecialchars($this->input->post('address')),
            'sex' => htmlspecialchars($this->input->post('sex')),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s")
        ];
        $this->db->insert('tb_customer', $data);


        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('customer');
    }
    
    public function edit_customer()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'phone' => htmlspecialchars($this->input->post('phone')),
            'address' => htmlspecialchars($this->input->post('address')),
            'sex' => htmlspecialchars($this->input->post('sex')),
            'updated' => date("Y-m-d H:i:s")
        ];
        
        $this->db->where('id_customer' , htmlspecialchars($this->input->post('id_customer')));
        $this->db->update('tb_customer', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil diubah</p></div>');
        redirect('customer');
    }

    public function hapus_customer()
    {
        $id = $this->input->post('id_customer');
        
        $this->db->where('id_customer', $id);
        $this->db->delete('tb_customer');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        redirect('customer');
    }

}
