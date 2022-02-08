<?php
class Report_model extends CI_Model
{


public function getSale($id = null)
    {
        $this->db->select('*, tb_customer.name as customer_name, tb_users.name as user_name, tb_sale.created as sale_created');
        $this->db->from('tb_sale');
        $this->db->join('tb_customer', 'tb_sale.id_customer = tb_customer.id_customer', 'left');
        $this->db->join('tb_users', 'tb_sale.id_user = tb_users.id_user', 'left');
        if($id != null){
            $this->db->where('id_sale', $id);
        }
        $this->db->order_by('id_sale', 'DESC');
        return $this->db->get();
    }

    public function getSaleDetail($id_sale = null)
    {
        $this->db->from('tb_sale_detail');
        $this->db->join('tb_item', 'tb_sale_detail.id_item = tb_item.id_item');
        if($id_sale != null){
            $this->db->where('tb_sale_detail.id_sale', $id_sale);
        }
        return $this->db->get();
    }

    public function hapus_sale()
    {
        $id = $this->input->post('id_sale');
        $this->db->where('id_sale', $id);
        $this->db->delete('tb_sale');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        redirect('report');
    }

    public function getSaleBy($tanggal = null, $sd = null, $pelanggan = null, $invoice = null)
    {
        $this->db->select('*, tb_customer.name as customer_name, tb_users.name as user_name, tb_sale.created as sale_created');
        $this->db->from('tb_sale');
        $this->db->join('tb_customer', 'tb_sale.id_customer = tb_customer.id_customer', 'left');
        $this->db->join('tb_users', 'tb_sale.id_user = tb_users.id_user', 'left');
        if($tanggal != null && $sd != null){
            $this->db->where('date >=', $tanggal);
            $this->db->where('date <=', $sd);
        }
        if($pelanggan != null){
            if($pelanggan == "umum"){
                $this->db->where('tb_sale.id_customer =', null);
            }else{
                $this->db->where('tb_sale.id_customer', $pelanggan);
            }
        }

        if($invoice != null){
            $this->db->where('invoice', $invoice);
        }

        $this->db->order_by('invoice', 'desc');
        return $this->db->get();
    }

    public function getStockBy($tanggal = null, $sd = null, $type = null, $pemasok = null)
    {
        $this->db->select('*, tb_item.name as item_name, tb_supplier.name as supplier_name, tb_users.name as user_name, tb_stock.created as stock_created');
        $this->db->from('tb_stock');
        $this->db->join('tb_supplier', 'tb_stock.id_supplier = tb_supplier.id_supplier', 'left');
        $this->db->join('tb_users', 'tb_stock.id_user = tb_users.id_user', 'left');
        $this->db->join('tb_item', 'tb_stock.id_item = tb_item.id_item', 'left');
        if($tanggal != null && $sd != null){
            $this->db->where('date >=', $tanggal);
            $this->db->where('date <=', $sd);
        }
        if($pemasok != null){
            if($pemasok == "null"){
                $this->db->where('tb_stock.id_supplier =', null);
            }else{
                $this->db->where('tb_stock.id_supplier', $pemasok);
            }
        }

        if($type != null){
            $this->db->where('type', $type);
        }

        $this->db->order_by('type', 'ASC');
        return $this->db->get();
    }



} 