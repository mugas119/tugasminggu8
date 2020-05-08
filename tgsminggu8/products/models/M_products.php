<?php

class M_products extends CI_Model{

    public function getAllProduct()
    {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('products');
        $this->db->join('category', 'products.cat_id = category.cat_id');
        $this->db->join('vendor', 'products.vend_id = vendor.vend_id');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function getAllVendor()
    {
        return $this->db->get('vendor')->result_array();
    }
    public function getProducts($pid)
    {   
        $this->db->where('prod_id', $pid);
        return $this->db->get('products')->result_array();
    }
    
    public function getAllCategory()
    {
        return $this->db->get('category')->result_array();
    }

    public function cekpid()
    {
        $query = $this->db->query("SELECT MAX(prod_id) as prodid from products");
        $hasil = $query->row();
        return $hasil->prodid;
    }

    public function addProd()
    {
        $id_produk = $this->input->post('prodid');
        $nama_produk = $this->input->post('prodname', true);
        $jml_produk = $this->input->post('prodqty', true);
        $vendor = $this->input->post('vend',true);
        $harga_produk = $this->input->post('prodprice', true);
        $kategori_produk = $this->input->post('prodcat', true);
        $deskripsi_produk = $this->input->post('proddesc', true);
        
        $config = array(
            'upload_path' => "./assets/img/products/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'file_name' => $this->session->userdata('username')."-".$id_produk.".png"
        );
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
		$this->upload->do_upload('upload_image');
        $data['result'] = print_r($this->upload->data(), true);
        $data['files']  = print_r($_FILES, true);
        $data['post']   = print_r($_POST, true);
        $data['errors'] = $this->upload->display_errors('<p>', '</p>');
        switch ($_FILES['upload_image']['error']) {
            case UPLOAD_ERR_OK:
            break;
            case UPLOAD_ERR_NO_FILE:
                $config['file_name'] = "default.png";
            case UPLOAD_ERR_INI_SIZE:
            break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
                redirect('products');
            default:
            $this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));  
            redirect('products');
        }  
            $keDB = array(
                'prod_id' => $id_produk,
                'prod_name' => $nama_produk,
                'prod_qty' => $jml_produk,
                'prod_image' => $config['file_name'],
                'vend_id' => $vendor,
                'cat_id' => $kategori_produk,
                'prod_price' => $harga_produk,
                'prod_desc' => $deskripsi_produk
            );
            $this->db->insert('products', $keDB);
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $username = $this->session->userdata('username');
            $keterangan = "Menambahkan produk $nama_produk";
            $data = array(
                'username' => $username,
                'ip' => $ip_address,
                'keterangan' => $keterangan,
                'jenis' => $id_produk,
                'tanggal' => date('Y-m-d H:i:s')
            );
            $this->db->insert('log', $data);

            redirect(base_url('products'));
    }
    public function editProd()
    {
        $id_produk = $this->input->post('prodid');
        $nama_produk = $this->input->post('prodname', true);
        $jml_produk = $this->input->post('prodqty', true);
        $vendor = $this->input->post('vend',true);
        $harga_produk = $this->input->post('prodprice', true);
        $kategori_produk = $this->input->post('prodcat', true);
        $deskripsi_produk = $this->input->post('proddesc', true);

        $config = array(
            'upload_path' => "./assets/img/products/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'file_name' => $this->session->userdata('username')."-".$id_produk.".png"
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('upload_image');

        $data['result'] = print_r($this->upload->data(), true);
        $data['files']  = print_r($_FILES, true);
        $data['post']   = print_r($_POST, true);
        switch ($_FILES['upload_image']['error']) {
            case UPLOAD_ERR_OK:


                $keDB = array(
                    'prod_id' => $id_produk,
                    'prod_name' => $nama_produk,
                    'prod_qty' => $jml_produk,
                    'prod_image' => $config['file_name'],
                    'vend_id' => $vendor,
                    'cat_id' => $kategori_produk,
                    'prod_price' => $harga_produk,
                    'prod_desc' => $deskripsi_produk
                );

            case UPLOAD_ERR_NO_FILE:
                $keDB = array(
                    'prod_id' => $id_produk,
                    'prod_name' => $nama_produk,
                    'prod_qty' => $jml_produk,
                    'vend_id' => $vendor,
                    'cat_id' => $kategori_produk,
                    'prod_price' => $harga_produk,
                    'prod_desc' => $deskripsi_produk
                );
            case UPLOAD_ERR_INI_SIZE:
            break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
                redirect('products');
            default:
            $data['username'] = $this->session->userdata('username');
            $data['errors'] = $this->upload->display_errors('<p>', '</p>');
            $this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
                $this->load->view('dashboard/template/home_header', $data);
                $this->load->view('dashboard/template/home_sidebar');
                $this->load->view('dashboard/template/home_topbar');
                $this->load->view('add', $data);
                $this->load->view('dashboard/template/home_footer');
        }
        
        $this->db->where('prod_id', $id_produk);
        $this->db->update('products', $keDB);
        
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $username = $this->session->userdata('username');
        $keterangan = "Mengubah produk $nama_produk";
        $data = array(
            'username' => $username,
            'ip' => $ip_address,
            'keterangan' => $keterangan,
            'jenis' => $id_produk,
            'tanggal' => date('Y-m-d H:i:s')
        );
        $this->db->insert('log', $data);  

        redirect('products');
    }
}