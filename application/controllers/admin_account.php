<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_account_model');
		$this->load->library('session');
		$this->load->library('access');
		
		$logged = $this->session->userdata('logged');
		if($logged == ""){
			redirect('home?err=1');
		}
	}
 	
	
	
	public function index() {
		
			$data_head['title'] = "My Account";
			$data_head['action'] = site_url().'/admin_account/form_action/';
			$data_head['withdraw'] = site_url().'/admin_account/withdraw/'.$this->session->userdata('user_id');
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			$result = $this->admin_account_model->read_id($this->session->userdata('user_id'));
				if($result){
					$data  = $result;
				}
			
			
			$serv = $_SERVER['PHP_SELF'];
			$serv = explode("/", $serv);
						
			$server = $_SERVER['HTTP_HOST']."/".$serv[1]."/index.php/register/rev/".$this->session->userdata('user_id');
			$data['link'] = $server;
			$data['my_transfer'] = $this->admin_account_model->get_my_transfer($this->session->userdata('user_id'));
			$data['new_transfer'] = $this->admin_account_model->get_new_transfer($this->session->userdata('user_id'));
			$data['total_transfer'] = $this->admin_account_model->get_total_transfer($this->session->userdata('user_id'));
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_account/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_action($id = 0) {
		
		 // simpan di table
		$data['page_name']	 				= $this->input->post('i_name');
		$data['account'] 				= $this->input->post('editor');
		
		
		if($id){
			$this->admin_account_model->update($data, $id);
		}else{
			
			$this->admin_account_model->create($data);
		}
		
		redirect("admin_account/form/$id");
		
	}
	

	public function withdraw($id = 0) {
		
		
		$this->admin_account_model->withdraw($id);
		
		redirect("admin_account/");
		
	}
	



	
}