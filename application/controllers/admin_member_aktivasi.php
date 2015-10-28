<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_member_aktivasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_member_aktivasi_model');
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
		
			$data_head['title'] = "Aktivasi VIP Member ";
			$data_head['add_button'] = site_url().'admin_member_aktivasi/form/';
			
			$data_user = array();
			$result = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result){
				$data_user  = $result;
			}
			
			$list =  $this->admin_member_aktivasi_model->list_data();
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_member_aktivasi/list', array('data_head' => $data_head, 'list' => $list));
			$this->load->view('admin_layout/footer'); 
	
 	}
	
	public function form($id = 0) {
		
			$data_head['title'] = "Aktivasi VIP Member ";
			$data_head['action'] = site_url().'admin_member_aktivasi/form_action/'.$id;
			$data_head['close_button'] = site_url().'admin_member_aktivasi/';
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			
			$data = array();
			$data['row_id'] = "";
			if($id){
				$result = $this->admin_member_aktivasi_model->read_id($id);
				if($result){
					$data  = $result;
					$data['row_id'] = $data['member_activation_id'];
				}
			}
			
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_member_aktivasi/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_action($id = 0) {
		
		
		

		$data['status'] = 1;
		$user_id = $this->admin_member_aktivasi_model->get_user_id($id);
		
		if($id){
			$this->admin_member_aktivasi_model->update($data, $id, $user_id);
		}
		
		redirect('admin_member_aktivasi/?did=2');
		
	}
	

	



	
}