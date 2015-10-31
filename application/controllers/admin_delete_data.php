<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_delete_data extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_delete_data_model');
		$this->load->library('session');
		$this->load->library('access');
		
		$logged = $this->session->userdata('logged');
		$user_type_id = $this->session->userdata('user_type_id');
		
		if($logged == ""){
			redirect('home');
		}else{
			if($user_type_id != 1){
				redirect('forbidden_page?err=1');
			}
		}
	}
 	
	public function index() {
		
			$data_head['title'] = "Delete Data ";
			$data_head['add_button'] = site_url().'admin_delete_data/form/';
			
			$data_user = array();
			$result = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result){
				$data_user  = $result;
			}
			
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_delete_data/form', array('data_head' => $data_head));
			$this->load->view('admin_layout/footer'); 
	
 	}
	
	
	public function form_action() {
		
		$this->admin_delete_data_model->delete();
		$this->admin_delete_data_model->delete_detail();
		
		redirect("admin_delete_data?did=1");
		
	}
	

	
	



	
}