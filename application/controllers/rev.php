<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rev extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('register_model');
		$this->load->library('access');
		$this->load->library('session');
		$this->load->helper('url');
		
		
	}
	
	

	public function index($username) {
		
		
		$data['title'] = "Contact Us";
		
		$user_id = $this->register_model->get_user_id($username);
		$this->session->set_userdata('reveral_id', $user_id);
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('register/index');
		$this->load->view('layout/footer'); 
		//echo "username :".$username;
 	}
	
	
}