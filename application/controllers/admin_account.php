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
			$data_head['action'] = site_url().'admin_account/form_action/';
			$data_head['withdraw'] = site_url().'admin_account/withdraw/'.$this->session->userdata('user_id');
			
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
			
			$data['status'] = ($data['activation_status'] == 1) ? "Sudah teraktivasi" : "Belum teraktivasi";
			$data['aktivasi'] = site_url().'admin_account/form_aktivasi/'.$this->session->userdata('user_id');
						
			$username = $this->admin_account_model->get_username($this->session->userdata('user_id'));
			$server = site_url()."rev/".$username;
			$data['link'] = ($data['activation_status'] == 1) ? $server : "-";
			$data['my_transfer'] = $this->admin_account_model->get_my_transfer($this->session->userdata('user_id'));
			$data['new_transfer'] = $this->admin_account_model->get_new_transfer($this->session->userdata('user_id'));
			$data['total_transfer'] = $this->admin_account_model->get_total_transfer($this->session->userdata('user_id'));
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_account/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_aktivasi($id = 0) {
		
			$data_head['title'] = "Aktivasi ";
			
			$data_head['close_button'] = site_url().'admin_account/';
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			
			$data = array();
			if($id){
				$result = $this->admin_account_model->read_activation_id($id);
				if($result){
					$data  = $result;
					$data['row_id'] = $data['member_activation_id'];
				}else{
					$data['row_id'] = '';
				}
			}
			
			$data_head['action'] = site_url().'admin_account/form_action/'.$data['row_id'];
			
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_account/form_aktivasi', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_action($id = 0) {
		
		 // simpan di table
		$data['user_id']	 			= $this->session->userdata('user_id');
		$data['bank_name'] 				= $this->input->post('i_bank_name');
		$data['bank_account_number'] 	= $this->input->post('i_bank_account_number');
		$data['bank_account_name'] 		= $this->input->post('i_bank_account_name');
		$data['bank_transfer'] 			= $this->input->post('i_bank_transfer');
		
		// upload gambar
		if($_FILES['i_img']['name']){

			if($id){
				$get_img = $this->admin_account_model->get_img("member_activations", "transfer_img", "member_activation_id = '$id'");
			
				$oldfile   = "assets/images/activation/".$get_img;
			
				if( file_exists( $oldfile ) ){
	    			unlink( $oldfile );
				}
			}

			$new_name = $this->upload_img('i_img');

			$data['transfer_img'] 					= str_replace(" ", "_", $new_name);

		}
		
		if($id){
			$this->admin_account_model->update($data, $id);
		}else{
			
			$this->admin_account_model->create($data);
		}
		
		redirect("admin_account?did=1");
		
	}
	

	public function withdraw($id = 0) {
		
		
		$this->admin_account_model->withdraw($id);
		
		redirect("admin_account/");
		
	}
	
	public function upload_img($img){
		$new_name = $this->session->userdata('user_id')."_".time()."_".$_FILES[$img]['name'];
			
			$configUpload['upload_path']    = './assets/images/activation/';                 #the folder placed in the root of project
			$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';       #allowed types description
			$config['max_size']	= '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';                       #max height
			$configUpload['encrypt_name']   = false;   
			$configUpload['file_name'] 		= $new_name;                      	#encrypt name of the uploaded file
			$this->load->library('upload', $configUpload);                  #init the upload class
			if(!$this->upload->do_upload($img)){
				$uploadedDetails    = $this->upload->display_errors();
			}else{
				$uploadedDetails    = $this->upload->data(); 
				//$this->_createThumbnail($uploadedDetails['file_name']);
	 
				//$thumbnail_name = $uploadedDetails['raw_name']. '_thumb' .$uploadedDetails['file_ext'];   
			}
			
			return $new_name;
	}
	



	
}