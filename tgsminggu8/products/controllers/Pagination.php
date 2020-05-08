<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
    class Products extends CI_Controller 
    {   
        public function __construct(){     
            parent::__construct();          
            $this->load->model('M_pagination'); 
            // Load M_pagination yang ada di folder models   
    }      
    
    public function index()
    {     
        redirect("products/lists"); 
        // Untuk redirect ke function lists   
    }      
    
    public function lists()
    {     
        $data['model'] = $this->M_pagination->view(); 
        // Panggil fungsi view() yang ada di model paginaiton         
        $this->load->view('view', $data);   
    } 
} 