<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('register_model');
		$this->load->library('access');
		$this->load->library('session');
		$this->load->helper('url');
	}
 	
	public function index() {
		
		$data['title'] = "Join Us / Register";
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('register/index');
		$this->load->view('layout/footer'); 
		
 	}
	
	public function rev($id) {
		
		$data['title'] = "Contact Us";
		$this->session->set_userdata('reveral_id', $id);
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('register/index');
		$this->load->view('layout/footer'); 
		
 	}
	
	public function signup() {
		 
		$data['user_type_id']	 				= 2;
		$data['user_login'] 					= $this->input->post('i_email');
		$data['user_code'] 						= $this->input->post('i_code');
		$data['user_password']	 				= md5($this->input->post('i_password'));
		$data['user_name']	 					= $this->input->post('i_name');
		$data['user_phone'] 					= $this->input->post('i_phone');
		$data['user_active_status']	 			= 1;
		$data['city_id'] 						= $this->input->post('i_city_id');
		$data['reveral_id']						= ($this->session->userdata('reveral_id')) ? $this->session->userdata('reveral_id') : 0;
		
		if($data['city_id'] == 0){
			$data['other_city_name']	 = $this->input->post('i_other_city_name');
		}
		
		$get_exist_login = $this->register_model->get_exist_login($data['user_login']);
		
		$get_exist_username = $this->register_model->get_exist_username($data['user_code']);
		
		if($get_exist_login > 0){
			redirect("register?err_reg=1");
		}else if($get_exist_username > 0){
			redirect("register?err_reg=2");
		}else if($this->input->post('i_password') != $this->input->post('i_confirm_password')){
			redirect("register?err_reg=3");
		}else{
		
		// upload gambar
		if($_FILES['i_img']['name']){
			$new_name = $this->upload_img('i_img');

			$data['user_img'] 					= str_replace(" ", "_", $new_name);

		}
		
		$id = $this->register_model->create_user($data);
		
		if($data['reveral_id']!=0){
			// create komisi reveral 1
			$reveral1 = $data['reveral_id'];
			$this->register_model->create_reveral($reveral1, $id, 1);
			
			// create komisi reveral 2
			$reveral2 = $this->register_model->get_reveral($reveral1);
			if($reveral2){
				$this->register_model->create_reveral($reveral2, $id, 2);
			}
			
			// create komisi reveral 3
			$reveral3 = $this->register_model->get_reveral($reveral2);
			if($reveral3){
				$this->register_model->create_reveral($reveral3, $id, 3);
			}
			
			// create komisi reveral 4
			$reveral4 = $this->register_model->get_reveral($reveral3);
			if($reveral4){
				$this->register_model->create_reveral($reveral4, $id, 4);
			}
			
			// create komisi reveral 5
			$reveral5 = $this->register_model->get_reveral($reveral4);
			if($reveral5){
				$this->register_model->create_reveral($reveral5, $id, 5);
			}
		}
		
		header("Location: ../register?did=1");
		}
		
 	}
	
	public function upload_img($img){
		$new_name = time()."_".$_FILES[$img]['name'];
			
			$configUpload['upload_path']    = './assets/images/user/';                 #the folder placed in the root of project
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