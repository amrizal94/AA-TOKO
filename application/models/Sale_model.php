<?php
class Sale_model extends CI_Model
{
    
//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice, 9, 4)) AS invoice_no 
                FROM tb_sale 
                WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        }else{
            $no = "0001";
        }
        $initials_invoice = setting_shop()['initials_invoice'];
        $invoice = $initials_invoice.date('ymd').$no;

        return $invoice;
    }

    public function add_cart($post)
    { 
        $query = $this->db->query("SELECT MAX(id_cart) AS cart_no FROM tb_cart");
        if($query->num_rows()){
            $row = $query->row();
            $cartno = ((int)$row->cart_no) + 1;
        }else{
            $cartno = 1;
        }
        $params = [
            "id_cart" => $cartno,
            "id_item" => $post['id_item'],
            "price" => $post['price'],
            "qty" => $post['qty'],
            "total" => ($post['price'] * $post['qty']),
            "id_user" => $this->session->userdata('id_user')
        ];

        $this->db->insert('tb_cart', $params);
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, tb_item.name as name_item, tb_cart.price as price_cart');
        $this->db->from('tb_cart');
        $this->db->join('tb_item', 'tb_cart.id_item = tb_item.id_item');
        if($params != null){
            $this->db->where($params);
        }
        $this->db->where('id_user', $this->session->userdata('id_user') );
        $query = $this->db->get();
        return $query;
    }

    public function update_cart_qty($post)
    {
        $this->db->set('price', $post['price']);
        $this->db->set('qty', 'qty + '.$post['qty'], FALSE);
        $this->db->set('total', 'qty * '.$post['price'], FALSE );
        $this->db->where('id_item', $post['id_item'] );
        $this->db->update('tb_cart');
    }

    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('tb_cart');
    }

    public function edit_cart($post)
    {
        $this->db->set('price', $post['price']);
        $this->db->set('qty', $post['qty']);
        $this->db->set('total', $post['total3']);
        $this->db->set('discount_item', $post['discount_item']);
        $this->db->where('id_cart', $post['id_cart'] );
        $this->db->update('tb_cart');
    }

    public function add_sale($post)
    {
        
        $params = [
            'invoice' => $this->invoice_no(),
            'id_customer' => $post['id_customer'] == "" ? null : $post['id_customer'],
            'total_price' => $post['sub_total'],
            'discount' => $post['discount'],
            'final_price' => $post['grand_total'],
            'cash' => $post['cash'],
            'remaining' => $post['change'],
            'note' => $post['note'],
            'date' => date('Y-m-d', strtotime( $post['date'] )),
            'id_user' => $this->session->userdata('id_user')
        ];

        $this->db->insert('tb_sale', $params);

        return $this->db->insert_id();
    }

    public function add_sale_detail($params)
    {
        $this->db->insert_batch('tb_sale_detail', $params);
    }

    public function getSale($id = null)
    {
        $this->db->select('*, tb_customer.name as customer_name, tb_users.name as user_name, tb_sale.created as sale_created');
        $this->db->from('tb_sale');
        $this->db->join('tb_customer', 'tb_sale.id_customer = tb_customer.id_customer', 'left');
        $this->db->join('tb_users', 'tb_sale.id_user = tb_users.id_user', 'left');
        if($id != null){
            $this->db->where('id_sale', $id);
        }
        return $this->db->get();
    }

    public function getSaleDetail($id_sale = null, $disc = null)
    {
        $this->db->from('tb_sale_detail');
        $this->db->join('tb_item', 'tb_sale_detail.id_item = tb_item.id_item');
        if($id_sale != null){
            $this->db->where('tb_sale_detail.id_sale', $id_sale);
        }
        if($disc != null){
            $this->db->where('discount_item', $disc);
        }
        return $this->db->get();
    }
    
    public function jumlahPenjualan($bulan = null, $tahun = null)
    {
        
        $sql = "SELECT * FROM tb_sale WHERE ";
        
        if ($bulan != null) {
            $sql .= "MONTH(date) = ". $bulan;
        }
        
        if ($tahun != null) {
            $sql .= " AND YEAR(date) = " . $tahun;
        } else {
            $sql .= " AND YEAR(date) = " .date('Y');
        }
        
        
        return $this->db->query($sql);
        
    }

    public function pendapatanPenjualan($bulan = null, $tahun = null)
    {
        
        $sql = "SELECT SUM(final_price) as pendapatan FROM tb_sale WHERE ";
        
        if ($bulan != null) {
            $sql .= "MONTH(date) = ". $bulan;
        }
        
        if ($tahun != null) {
            $sql .= " AND YEAR(date) = " . $tahun;
        } else {
            $sql .= " AND YEAR(date) = " .date('Y');
        }
        
        return $this->db->query($sql);
    }
    
    public function produkBulananTerlaris($bulan = null, $tahun = null)
    {
        $sql = "SELECT tb_item.name, SUM(tb_sale_detail.qty) as jumlah
                FROM tb_sale_detail 
                left join tb_item on tb_item.id_item = tb_sale_detail.id_item
                left join tb_sale on tb_sale.id_sale = tb_sale_detail.id_sale
                WHERE MONTH(tb_sale.date) = " . $bulan ." AND YEAR(tb_sale.date) = " . $tahun . " GROUP BY tb_item.name ORDER by jumlah desc LIMIT 10";
                
        return $this->db->query($sql);
    }
    
}