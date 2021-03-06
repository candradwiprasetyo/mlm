<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('access');
		$this->load->library('session');
		$this->load->helper('url');
		
		if(!$this->session->userdata('visitor')){
			$visitor_counter = $this->access->get_visitor();
			$this->session->set_userdata('visitor', $visitor_counter);
			$this->access->create_visitor($visitor_counter);
		}
	}
 	
	public function index() {
		
		$data['title'] = "About Us";
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('about_us/index');
		$this->load->view('layout/footer'); 
		
 	}
	
	
}