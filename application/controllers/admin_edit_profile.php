<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_edit_profile extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_edit_profile_model');
		$this->load->library('session');
		$this->load->library('access');
		
		$logged = $this->session->userdata('logged');
		if($logged == ""){
			redirect('home?err=1');
		}
	}

	
	public function form() {
		
			$id = $this->session->userdata('user_id');
			$data_head['title'] = "Edit Profile";
			$data_head['action'] = site_url().'admin_edit_profile/form_action/'.$id;
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($id);
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			
			$data = array();
			$data['row_id'] = "";
			if($id){
				$result = $this->admin_edit_profile_model->read_id($id);
				if($result){
					$data  = $result;
					$data['row_id'] = $data['user_id'];
				}
			}
			
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_edit_profile/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_action($id = 0) {
		
		
		
		$data['user_login']	 				= $this->input->post('i_email');
		if($this->input->post('i_password')){
			$data['user_password']			= md5($this->input->post('i_password'));
		}
		$data['user_name']	 				= $this->input->post('i_name');
		$data['user_phone']	 				= $this->input->post('i_phone');
		$data['city_id']	 				= $this->input->post('i_city_id');
		
		// upload gambar
		if($_FILES['i_img']['name']){

			if($id){
				$get_img = $this->admin_edit_profile_model->get_img("users", "user_img", "user_id = '$id'");
			
				$oldfile   = "assets/images/user/".$get_img;
			
				if( file_exists( $oldfile ) ){
	    			unlink( $oldfile );
				}
			}

			$new_name = $this->upload_img('i_img');

			$data['user_img'] 					= str_replace(" ", "_", $new_name);

		}
		
		
		if($id){
			$this->admin_edit_profile_model->update($data, $id);
		}
		
		redirect("admin_edit_profile/form/?did=1");
		
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