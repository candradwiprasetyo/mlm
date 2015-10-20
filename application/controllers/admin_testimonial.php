<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_testimonial extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('admin_testimonial_model');
		$this->load->library('session');
		$this->load->library('access');
		
		$logged = $this->session->userdata('logged');
		if($logged == ""){
			redirect('home?err=1');
		}
	}
 	
	public function index() {
		
			$data_head['title'] = "Testimonial ";
			$data_head['add_button'] = site_url().'admin_testimonial/form/';
			
			$data_user = array();
			$result = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result){
				$data_user  = $result;
			}
			
			$list =  $this->admin_testimonial_model->list_data();
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_testimonial/list', array('data_head' => $data_head, 'list' => $list));
			$this->load->view('admin_layout/footer'); 
	
 	}
	
	public function form($id = 0) {
		
			$data_head['title'] = "Testimonial ";
			$data_head['action'] = site_url().'admin_testimonial/form_action/'.$id;
			$data_head['close_button'] = site_url().'admin_testimonial/';
			
			$data_user = array();
			$result_user = $this->access->get_data_user_admin($this->session->userdata('user_id'));
			
			if($result_user){
				$data_user  = $result_user;
			}
			
			
			$data = array();
			$data['row_id'] = "";
			if($id){
				$result = $this->admin_testimonial_model->read_id($id);
				if($result){
					$data  = $result;
					$data['row_id'] = $data['testimonial_id'];
				}
			}
			
			
			$this->load->view('admin_layout/header', array( 'data_head' => $data_head, 'data_user' => $data_user));
			$this->load->view('admin_testimonial/form', array('data_head' => $data_head, 'data' => $data));
			$this->load->view('admin_layout/footer'); 
		
 	}
	
	public function form_action($id = 0) {
		
		// upload gambar
		if($_FILES['i_img']['name']){

			if($id){
				$get_img = $this->admin_testimonial_model->get_img("testimonials", "testimonial_img", "testimonial_id = '$id'");
			
				$oldfile   = "assets/images/testimonial/".$get_img;
			
				if( file_exists( $oldfile ) ){
	    			unlink( $oldfile );
				}
			}

			$new_name = $this->upload_img('i_img');

			$data['testimonial_img'] 					= str_replace(" ", "_", $new_name);

		}

		

		 
		 // simpan di table
		$data['testimonial_name']	 				= $this->input->post('i_name');
		$data['testimonial_desc'] 					= $this->input->post('editor');
		
		
		if($id){
			$this->admin_testimonial_model->update($data, $id);
		}else{
			$data['testimonial_date'] = date("Y-m-d H:m:s");
			$this->admin_testimonial_model->create($data);
		}
		
		redirect('admin_testimonial/?did=2');
		
	}
	
	public function delete($id){
		$this->admin_testimonial_model->delete($id);
		
		
				$get_img = $this->admin_testimonial_model->get_img("testimonials", "testimonial_img", "testimonial_id = '$id'");
			
				$oldfile   = "assets/images/testimonial/".$get_img;
			
				if( file_exists( $oldfile ) ){
	    			unlink( $oldfile );
				}
			
		
		redirect('admin_testimonial/?did=3');
	}
	
	public function active($id){
		$this->admin_testimonial_model->active($id);
		
		redirect('admin_testimonial/?did=4');
	}
	
	public function non_active($id){
		$this->admin_testimonial_model->non_active($id);
		
		redirect('admin_testimonial/?did=5');
	}

	public function upload_img($img){
		$new_name = time()."_".$_FILES[$img]['name'];
			
			$configUpload['upload_path']    = './assets/images/testimonial/';                 #the folder placed in the root of project
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