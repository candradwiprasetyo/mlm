<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketing extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('access');
		$this->load->library('session');
		$this->load->helper('url');
	}
 	
	public function index() {
		
		$data['title'] = "Marketing & Business Plan";
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('marketing/index');
		$this->load->view('layout/footer'); 
		
 	}
	
	
}