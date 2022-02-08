<?php
class item_model extends CI_Model
{

//   Iriansyah Ahmad M 
//   ryanpdw10@gmail.com
//   https://ini.space/ryanpdw

    // start datatables
    // start datatables
    var $column_order = array(null, 'barcode', 'tb_item.name', 'category_name', 'unit_name', 'price', 'stock', 'created', 'updated'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'tb_item.name', 'price', 'stock'); //set column field database for datatable searchable
    var $order = array('tb_item.name' => 'ASC'); // default order
 
    private function _get_datatables_query() {
        $this->db->select('tb_item.*, tb_category.name as category_name, tb_unit.name as unit_name');
        $this->db->from('tb_item');
        $this->db->join('tb_category', 'tb_item.id_category = tb_category.id_category');
        $this->db->join('tb_unit', 'tb_item.id_unit = tb_unit.id_unit');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('tb_item');
        return $this->db->count_all_results();
    }
    // end datatables
    // end datatables


    public function get($id = null)
    {
        if ($id != null) {
            $this->db->where('id_item', $id);
        }
        return $this->db->get('tb_item')->row_array();
    }

    public function getAll()
    {
        $this->db->select('tb_item.*, tb_category.name as name_category, tb_unit.name as name_unit');
        $this->db->from('tb_item');
        $this->db->join('tb_category', 'tb_category.id_category = tb_item.id_category');
        $this->db->join('tb_unit', 'tb_unit.id_unit = tb_item.id_unit');
        $this->db->ORDER_BY('stock', 'DESC');
        return $this->db->get()->result_array();
    } 

    public function getSemua()
    {
        $this->db->select('tb_item.*, tb_category.name as name_category, tb_unit.name as name_unit');
        $this->db->from('tb_item');
        $this->db->join('tb_category', 'tb_category.id_category = tb_item.id_category');
        $this->db->join('tb_unit', 'tb_unit.id_unit = tb_item.id_unit');
        $this->db->ORDER_BY('name', 'ASC');
        return $this->db->get();
    } 
  
    public function tambah_item()
    {
         $data = [
            'barcode' => htmlspecialchars($this->input->post('barcode')),
            'name' => htmlspecialchars($this->input->post('fullname')),
            'id_category' => htmlspecialchars($this->input->post('category')),
            'id_unit' => htmlspecialchars($this->input->post('unit')),
            'price' => htmlspecialchars($this->input->post('price')),
            'stock' => 0,
            'created' => date("Y-m-d H:i:s"),
            'updated' => date("Y-m-d H:i:s")
        ];

        $uppload_image = $_FILES['image']['name'];

        if ($uppload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['upload_path']   = './assets/image/barang/';
            $config['max_size']      = '5048';
            $config['file_name']     = 'item-'.date('ymd').substr(md5(rand()),0,10);

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $error =  $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> '.$error.'</p></div>');
                redirect('item');
            }
        }

        $this->db->insert('tb_item', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil ditambah</p></div>');
        redirect('item');
    }
    
    public function edit_item()
    {
         $data = [
            'barcode' => htmlspecialchars($this->input->post('barcode')),
            'name' => htmlspecialchars($this->input->post('fullname')),
            'id_category' => htmlspecialchars($this->input->post('category')),
            'id_unit' => htmlspecialchars($this->input->post('unit')),
            'price' => htmlspecialchars($this->input->post('price')),
            'updated' => date("Y-m-d H:i:s")
        ];
        
        $uppload_image = $_FILES['image']['name'];

        if ($uppload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['upload_path']   = './assets/image/barang/';
            $config['max_size']      = '5048';
            $config['file_name']     = 'item-'.date('ymd').substr(md5(rand()),0,10);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $old_image = htmlspecialchars($this->input->post('nama-gambar'));
                unlink(FCPATH . 'assets/image/barang/' . $old_image);
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $error =  $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> '.$error.'</p></div>');
                redirect('item');
            }
        }

        $this->db->where('id_item' , htmlspecialchars($this->input->post('id_item')));
        $this->db->update('tb_item', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil diubah</p></div>');
        redirect('item');
    }

    public function hapus_item()
    {
        $id = $this->input->post('id_item');
        $image = $this->item_model->get($this->input->post('id_item'));
        if ($image) {
            unlink(FCPATH . 'assets/image/barang/' . $image['image']);
        }

        $this->db->where('id_item', $id);
        $this->db->delete('tb_item');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><i class="icon fa fa-check"></i> Data berhasil dihapus</p></div>');
        redirect('item');
    }

    public function update_stock_in()
    {
        $qty = htmlspecialchars($this->input->post('qty'));
        $id_item = htmlspecialchars($this->input->post('id_item'));
        $this->db->set("stock", "stock + $qty", FALSE); 
        $this->db->set("updated", date("Y-m-d H:i:s")); 
        $this->db->where('id_item', $id_item);
        $this->db->update('tb_item');
    }

    public function downdate_stock_in()
    {
        $qty = htmlspecialchars($this->input->post('qty'));
        $id_item = htmlspecialchars($this->input->post('id_item'));
        $this->db->set("stock", "stock - $qty", FALSE); 
        $this->db->set("updated", date("Y-m-d H:i:s")); 
        $this->db->where('id_item', $id_item);
        $this->db->update('tb_item');
    }

    public function update_stock_out()
    {
        $qty = htmlspecialchars($this->input->post('qty'));
        $id_item = htmlspecialchars($this->input->post('id_item'));
        $this->db->set("stock", "stock - $qty", FALSE); 
        $this->db->set("updated", date("Y-m-d H:i:s")); 
        $this->db->where('id_item', $id_item);
        $this->db->update('tb_item');
    }

    public function downdate_stock_out()
    {
        $qty = htmlspecialchars($this->input->post('qty'));
        $id_item = htmlspecialchars($this->input->post('id_item'));
        $this->db->set("stock", "stock + $qty", FALSE); 
        $this->db->set("updated", date("Y-m-d H:i:s")); 
        $this->db->where('id_item', $id_item);
        $this->db->update('tb_item');
    }
    
    public function getStockMin()
    {
        $this->db->select('name, stock');
        $this->db->from('tb_item');
        $this->db->ORDER_BY('stock', 'ASC');
        $this->db->where('stock <=',10);
        $this->db->limit(10);
        return $this->db->get();
    } 
} 