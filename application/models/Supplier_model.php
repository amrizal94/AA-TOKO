<?php
class Supplier_model extends CI_Model
{

//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    public function get($id = null)
    {
        if ($id != null) {
            $this->db->where('id_supplier', $id);
        }

        return $this->db->get('tb_supplier')->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_supplier')->result_array();
    } 

    public function getSemua()
    {
        return $this->db->get('tb_supplier');
    } 

    public function tambah_supplier()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'phone' => htmlspecialchars($this->input->post('phone')),
            'address' => htmlspecialchars($this->input->post('address')),
            'description' => htmlspecialchars($this->input->post('description')),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s")
        ];
        $this->db->insert('tb_supplier', $data);


        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('supplier');
    }
    
    public function edit_supplier()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'phone' => htmlspecialchars($this->input->post('phone')),
            'address' => htmlspecialchars($this->input->post('address')),
            'description' => htmlspecialchars($this->input->post('description')),
            'updated' => date("Y-m-d H:i:s")
        ];
        
        $this->db->where('id_supplier' , htmlspecialchars($this->input->post('id_supplier')));
        $this->db->update('tb_supplier', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil diubah</p></div>');
        redirect('supplier');
    }

    public function hapus_supplier()
    {
        $id = $this->input->post('id_supplier');
        
        $this->db->where('id_supplier', $id);
        $this->db->delete('tb_supplier');
        
        $error = $this->db->error();
        if($error['code'] != 0){
           $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-times"></i> Data tidak bisa dihapus! (sudah berelasi)</p></div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        }

        redirect('supplier');
    }

}
