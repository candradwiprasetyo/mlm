<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forbidden_page extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('access');
		$this->load->library('session');
		$this->load->helper('url');
	}
 	
	public function index() {
		
			$data_head['title'] = "Testimonial ";
			$data_head['add_button'] = site_url().'admin_testimonial/form/';
			
			$data_user = array();
			$result = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result){
				$data_user  = $result;
			}
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('forbidden_page/content', array('data_head' => $data_head));
			$this->load->view('admin_layout/footer'); 
	
 	}
	
	
}