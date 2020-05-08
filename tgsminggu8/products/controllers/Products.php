<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('m_products');
        $this->simple_login->cek_admin();
        date_default_timezone_set('Asia/Jakarta');
        
    }
    
    public function index()
	{
		$data['title'] = "Daftar Produk";
        $data['product'] = $this->m_products->getAllProduct();
        $data['username'] = $this->session->userdata('username');
		$this->load->view('dashboard/template/home_header', $data);
		$this->load->view('dashboard/template/home_sidebar',$data);
		$this->load->view('dashboard/template/home_topbar', $data);
		$this->load->view('index', $data);
		$this->load->view('dashboard/template/home_footer');
	}

	public function add()
	{
        $dariDB = $this->m_products->cekpid();
        $nourut = substr($dariDB, 2, 5);
        $prodidSekarang = $nourut + 1;
        $data['prod_id'] = $prodidSekarang;
        $data['cat'] = $this->m_products->getAllCategory();
        $data['vnd'] = $this->m_products->getAllVendor();
        if(!$this->m_products->getAllCategory()){
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan, silahkan tambahkan kategori terlebih dahulu');
            redirect('products');
        } else {
            $data['title'] = "Tambah Produk";
            $data['username'] = $this->session->userdata('username');
            $this->load->view('dashboard/template/home_header', $data);
            $this->load->view('dashboard/template/home_sidebar',$data);
            $this->load->view('dashboard/template/home_topbar', $data);
            $this->load->view('add', $data);
            $this->load->view('dashboard/template/home_footer');
        }
	}

	public function edit($pid)
	{
		$data['title'] = "Edit Produk";
        $data['cat'] = $this->m_products->getAllCategory();
        $data['vnd'] = $this->m_products->getAllVendor();
		$data['edit'] = $this->m_products->getProducts($pid);
        $data['username'] = $this->session->userdata('username');
		$this->load->view('dashboard/template/home_header', $data);
		$this->load->view('dashboard/template/home_sidebar',$data);
		$this->load->view('dashboard/template/home_topbar', $data);
		$this->load->view('edit', $data);
		$this->load->view('dashboard/template/home_footer');
	}

    public function saveAdd()
    {
        $username = $this->session->userdata('username');

        $this->form_validation->set_rules('prodname', 'Nama', 'trim|required');
        $this->form_validation->set_rules('prodqty', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('vend', 'Vendor', 'trim|required');
        $this->form_validation->set_rules('prodprice', 'Price', 'trim|required');
        $this->form_validation->set_rules('prodcat', 'Category', 'trim|required');
        $this->form_validation->set_rules('proddesc', 'Description', 'trim|required');
        

        if ($this->form_validation->run() == false) {
            $data['errors'] = null;
            $this->load->view('dashboard/template/home_header', $data);
            $this->load->view('dashboard/template/home_sidebar',$data);
            $this->load->view('dashboard/template/home_topbar');
            $this->load->view('add', $data);
            $this->load->view('dashboard/template/home_footer');
        } else {
            $this->m_products->addProd();
        }
    
    }
	
    public function saveEdit()
    {
        $username = $this->session->userdata('username');

        if ($username == '') {
            redirect('login');
        } else {
            $this->form_validation->set_rules('prodname', 'Nama', 'trim|required');
            $this->form_validation->set_rules('prodqty', 'Quantity', 'trim|required');
            $this->form_validation->set_rules('vend', 'Vendor', 'trim|required');
            $this->form_validation->set_rules('prodprice', 'Price', 'trim|required');
            $this->form_validation->set_rules('prodcat', 'Category', 'trim|required');
            $this->form_validation->set_rules('proddesc', 'Description', 'trim|required');

            if ($this->form_validation->run() == false) {
				$data['errors'] = null;
				$this->index();
            } else {
                $this->m_products->editProd();
            }
        }
    }

    public function delete($pid)
    {
        $this->delImg($pid);
        redirect('products');
    }
    function delImg($pid)
        {
            $this->db->where('prod_id', $pid);
            $image = $this->db->get('products')->result_array();
            foreach ($image as $p) :
            $id_produk = $p['prod_id'];
            $nama = $p['prod_name'];
            $gambar = $p['prod_image'];
            $path = "./assets/img/products/$gambar";
            if ($gambar == "default.png") {
                $this->db->where('prod_id', $pid);
                $this->db->delete('products');
            }else {
                unlink($path);
                $this->db->where('prod_id', $pid);
                $this->db->delete('products');
            }
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $username = $this->session->userdata('username');
            $keterangan = "Menghapus produk $nama";
            $data = array(
                'username' => $username,
                'ip' => $ip_address,
                'keterangan' => $keterangan,
                'jenis' => $id_produk,
                'tanggal' => date('Y-m-d H:i:s')
            );
            $this->db->insert('log', $data);
            endforeach;
        }
}
?>