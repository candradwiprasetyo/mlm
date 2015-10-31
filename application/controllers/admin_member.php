<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_member extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_member_model');
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
		
			$data_head['title'] = "Member ";
			$data_head['add_button'] = site_url().'admin_member/form/';
			
			$data_user = array();
			$result = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result){
				$data_user  = $result;
			}
			
			$list =  $this->admin_member_model->list_data();
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_member/list', array('data_head' => $data_head, 'list' => $list));
			$this->load->view('admin_layout/footer'); 
	
 	}
	
	public function form($id = 0) {
		
			$data_head['title'] = "Account";
			$data_head['action'] = site_url().'admin_account/form_action/';
			$data_head['withdraw'] = site_url().'admin_account/withdraw/';
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			$result = $this->admin_member_model->read_id($id);
				if($result){
					$data  = $result;
				}
		
			
			$serv = $_SERVER['PHP_SELF'];
			$serv = explode("/", $serv);
			$data['id'] = $id;
			
			$data['status'] = ($data['activation_status'] == 1) ? "Sudah teraktivasi" : "Belum teraktivasi";
			$data['aktivasi'] = site_url().'admin_member/form_aktivasi/';
						
			$username = $this->admin_member_model->get_username($this->session->userdata('user_id'));
			$server = site_url()."rev/".$username;
			$data['link'] = ($data['activation_status'] == 1) ? $server : "-";
			$data['my_transfer'] = $this->admin_member_model->get_my_transfer($id);
			$data['new_transfer'] = $this->admin_member_model->get_new_transfer($id);
			$data['total_transfer'] = $this->admin_member_model->get_total_transfer($id);
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_member/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function nonactive_member($id){
		$this->admin_member_model->nonactive_member($id);
		
		redirect('admin_member/?did=1');
	}
	
	public function active_member($id){
		$this->admin_member_model->active_member($id);
		
		redirect('admin_member/?did=2');
	}

	
	public function delete($id){
		
		
		
				$get_img = $this->admin_member_model->get_img("users", "user_img", "user_id = '$id'");
			
				$oldfile   = "assets/images/user/".$get_img;
			
				if( file_exists( $oldfile ) ){
	    			unlink( $oldfile );
				}
				
		$this->admin_member_model->delete($id);	
		
		redirect('admin_member/?did=3');
	}
	
}