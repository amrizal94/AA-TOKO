<?php
class Unit_model extends CI_Model
{

//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    public function get($id = null)
    {
        if ($id != null) {
            $this->db->where('id_unit', $id);
        }

        return $this->db->get('tb_unit')->row_array();
    }

    public function getAll()
    {
        $this->db->ORDER_BY('name', 'ASC');
        return $this->db->get('tb_unit')->result_array();
    } 

    public function tambah_unit()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s")
        ];
        $this->db->insert('tb_unit', $data);


        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('unit');
    }
    
    public function edit_unit()
    {
         $data = [
            'name' => htmlspecialchars($this->input->post('fullname')),
            'updated' => date("Y-m-d H:i:s")
        ];
        
        $this->db->where('id_unit' , htmlspecialchars($this->input->post('id_unit')));
        $this->db->update('tb_unit', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil diubah</p></div>');
        redirect('unit');
    }

    public function hapus_unit()
    {
        $id = $this->input->post('id_unit');
        
        $this->db->where('id_unit', $id);
        $this->db->delete('tb_unit');

         $error = $this->db->error();
        if($error['code'] != 0){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-times"></i> Data tidak bisa dihapus! (sudah berelasi)</p></div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        }
        redirect('unit');
    }

}
