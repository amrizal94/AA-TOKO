<?php
class Stock_model extends CI_Model
{
   
//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw
 
    public function getAll()
    {
        $this->db->select('tb_stock.*, tb_item.barcode, tb_item.name as name_item, tb_supplier.name as name_supplier, tb_users.name as name_user' );
        $this->db->from('tb_stock');
        $this->db->join('tb_item', 'tb_item.id_item = tb_stock.id_item', 'LEFT');
        $this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_stock.id_supplier', 'LEFT');
        $this->db->join('tb_users', 'tb_users.id_user = tb_stock.id_user', 'LEFT');
        $this->db->ORDER_BY('id_stock', 'DESC');
        return $this->db->get();
    }

    public function getAllStockIn()
    {
        $this->db->select('tb_stock.*, tb_item.barcode, tb_item.name as name_item, tb_supplier.name as name_supplier, tb_users.name as name_user' );
        $this->db->from('tb_stock');
        $this->db->join('tb_item', 'tb_item.id_item = tb_stock.id_item', 'LEFT');
        $this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_stock.id_supplier', 'LEFT');
        $this->db->join('tb_users', 'tb_users.id_user = tb_stock.id_user', 'LEFT');
        $this->db->ORDER_BY('id_stock', 'DESC');
        $this->db->where('type', 'in');
        return $this->db->get();
    } 

    public function getAllStockOut()
    {
        $this->db->select('tb_stock.*, tb_item.barcode, tb_item.name as name_item, tb_supplier.name as name_supplier, tb_users.name as name_user' );
        $this->db->from('tb_stock');
        $this->db->join('tb_item', 'tb_item.id_item = tb_stock.id_item', 'LEFT');
        $this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_stock.id_supplier', 'LEFT');
        $this->db->join('tb_users', 'tb_users.id_user = tb_stock.id_user', 'LEFT');
        $this->db->ORDER_BY('id_stock', 'DESC');
        $this->db->where('type', 'out');
        return $this->db->get();
    } 

    public function tambah_stock_in()
    {
         $data = [
            'id_item' => htmlspecialchars($this->input->post('id_item')),
            'type' => 'in',
            'detail' => htmlspecialchars($this->input->post('detail')),
            'id_supplier' => $this->input->post('supplier') == '' ? null : htmlspecialchars($this->input->post('supplier')),
            'purchase_price' => htmlspecialchars($this->input->post('purchase_price')),
            'qty' => htmlspecialchars($this->input->post('qty')),
            'total_price' => htmlspecialchars($this->input->post('total_price')),
            'date' => htmlspecialchars($this->input->post('tanggal')),
            'note' => htmlspecialchars($this->input->post('note')),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s"),
            'id_user' => $this->fungsi->user_login()['id_user']
        ];
        $this->db->insert('tb_stock', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('stock/in');
    }

    public function hapus_stock_in()
    {
        $id_stock = $this->input->post('id_stock');
        
        $this->db->where('id_stock', $id_stock);
        $this->db->delete('tb_stock');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        redirect('stock/in');
    }

    
    public function tambah_stock_out()
    {
         $data = [
            'id_item' => htmlspecialchars($this->input->post('id_item')),
            'type' => 'out',
            'detail' => htmlspecialchars($this->input->post('detail')),
            'qty' => htmlspecialchars($this->input->post('qty')),
            'date' => htmlspecialchars($this->input->post('tanggal')),
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s"),
            'id_user' => $this->fungsi->user_login()['id_user']
        ];
        $this->db->insert('tb_stock', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('stock/out');
    }

    public function hapus_stock_out()
    {
        $id_stock = $this->input->post('id_stock');
        
        $this->db->where('id_stock', $id_stock);
        $this->db->delete('tb_stock');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        redirect('stock/out');
    }
}
