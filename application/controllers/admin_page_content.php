<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_page_content extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_page_content_model');
		$this->load->library('session');
		$this->load->library('access');
		
		$logged = $this->session->userdata('logged');
		if($logged == ""){
			redirect('home?err=1');
		}
	}
 	
	public function index() {
		
			$data_head['title'] = "Page content ";
			$data_head['add_button'] = site_url().'/admin_page_content/form/';
			
			$data_user = array();
			$result = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result){
				$data_user  = $result;
			}
			
			$list =  $this->admin_page_content_model->list_data();
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_page_content/list', array('data_head' => $data_head, 'list' => $list));
			$this->load->view('admin_layout/footer'); 
	
 	}
	
	public function form($id = 0) {
		
			$data_head['title'] = $this->admin_page_content_model->get_page_name($id);
			$data_head['action'] = site_url().'/admin_page_content/form_action/'.$id;
			$data_head['close_button'] = site_url().'/admin_page_content/';
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			
			$data = array();
			$data['row_id'] = "";
			if($id){
				$result = $this->admin_page_content_model->read_id($id);
				if($result){
					$data  = $result;
					$data['row_id'] = $data['page_id'];
				}
			}
			
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_page_content/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_action($id = 0) {
		
	

		

		 
		 // simpan di table
		$data['page_name']	 				= $this->input->post('i_name');
		$data['page_content'] 				= $this->input->post('editor');
		
		
		if($id){
			$this->admin_page_content_model->update($data, $id);
		}else{
			
			$this->admin_page_content_model->create($data);
		}
		
		redirect("admin_page_content/form/$id");
		
	}
	

	
	



	
}