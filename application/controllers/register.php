<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('register_model');
		$this->load->library('access');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('recaptcha');
		
		if(!$this->session->userdata('visitor')){
			$visitor_counter = $this->access->get_visitor();
			$this->session->set_userdata('visitor', $visitor_counter);
			$this->access->create_visitor($visitor_counter);
		}
	}
 	
	public function index() {
		
		$data['title'] = "Join Us / Register";
		
		// captcha lama
		/*
		$this->load->helper('captcha');
		$vals = array(
			'image' => 'test', 
			'img_path' => './assets/capimg/',
			'img_url' => site_url().'assets/capimg/',
			 'img_width'	=> 100,
			'img_height' => 30,
			'expiration' => 7200
			);
		
		$cap = create_captcha($vals);
		
		$data_cap = array(
			'captcha_time'	=> $cap['time'],
			'ip_address'	=> $this->input->ip_address(),
			'word'	=> $cap['word']
			
			);
			
			// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	
		
		$query = $this->db->insert_string('captcha', $data_cap);
		$this->db->query($query);
		
		$this->session->set_userdata('keycode',md5($cap['word']));
		$data_img['captcha_img'] = $cap['image'];
	*/
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('register/index');
		$this->load->view('layout/footer'); 
		
 	}
	
	public function forgot_password() {
		
		$data['title'] = "Forgot Password";
		
 		$this->load->view('layout/header', array('data' => $data));
		$this->load->view('register/forgot_password');
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
		$random 								= rand(1, 999);
		if(strlen($random) == 1){
			$random = "00".$random;
		}elseif(strlen($random) == 2){
			$random = "0".$random;
		}
		$data['user_transfer']					= "200".$random;
		$data['user_bank_name'] 				= $this->input->post('i_user_bank_name');
		$data['user_bank_account_number'] 		= $this->input->post('i_user_bank_account_number');
		$data['user_bank_account_name'] 		= $this->input->post('i_user_bank_account_name');
		
		if($data['city_id'] == 0){
			$data['other_city_name']	 = $this->input->post('i_other_city_name');
		}
		
		//$captcha = $this->input->post('i_captcha');
		//if(md5($captcha)==$this->session->userdata('keycode')){
		// Catch the user's answer
		$captcha_answer = $this->input->post('g-recaptcha-response');
		
		// Verify user's answer
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		
		// Processing ...	
		if ($response['success']) {
		
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
			
			// kirim email
			$this->sendMail($data['user_login'], $data['user_transfer']);
			
			header("Location: ../register?did=1");
			}
			
		}else{
			redirect("register?err_reg=4");
		}
		
 	}
	
	public function reset_password() {
		 
		$data['email'] 					= $this->input->post('i_email');
		
	
		$get_exist_login = $this->register_model->get_exist_login($data['email']);
		

    	
		
		
		
		if($get_exist_login > 0){
			
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    		$new_password = substr(str_shuffle($chars),0,8);
			
			$this->register_model->update_password($data['email'], $new_password);
			// kirim email
			$this->sendMailReset($data['email'], $new_password);
			//$this->sendMailReset_manual();
		
		
			redirect("register/forgot_password?did=1");
			
		}else {
			redirect("register/forgot_password?err_reset=1");
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
	
	/*function sendMail(){
		$this->load->library('email');

		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_user' => 'bisnisiob@gmail.com',
		  'smtp_pass' => 'hondatoyotasuzuki',
		  'smtp_port' => 465,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));
		
		$this->email->from('bisnisiob@gmail.com', 'Admin IOB');
		$this->email->to('candradwiprasetyo@gmail.com');
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		$this->email->send();
		
		echo $this->email->print_debugger();
	}*/
	
	function sendMail($email, $transfer) {
		
        $ci = get_instance();
        $ci->load->library('email');
        
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "bisnisiob@gmail.com";
        $config['smtp_pass'] = "hondatoyotasuzuki";
        //$config['smtp_crypto'] = 'ssl';
        
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        
		
        $ci->email->initialize($config);
 		
		$data['total_transfer'] = $transfer;
		
        $ci->email->from('bisnisiob@gmail.com', 'Admin IOB');
        $ci->email->to($email);
        $ci->email->subject('Registrasi IOB');
       
        $message=$this->load->view('register/email',$data,TRUE);
		$ci->email->message($message);
		if ($this->email->send()) {
            //echo 'Email sent.';
        } else {
            //show_error($this->email->print_debugger());
        }
    }
	
	function sendMailReset($email, $new_password) {
		
        $ci = get_instance();
        $ci->load->library('email');
        
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "bisnisiob@gmail.com";
        $config['smtp_pass'] = "hondatoyotasuzuki";
        
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
		//$config['smtp_crypto'] = 'ssl';
        
		
        $ci->email->initialize($config);
 		
		$data['new_password'] = $new_password;
		
        $ci->email->from('bisnisiob@gmail.com', 'Admin IOB');
        $ci->email->to($email);
        $ci->email->subject('Reset Password IOB');
       
        $message=$this->load->view('register/reset_password',$data,TRUE);
		$ci->email->message($message);
		if ($this->email->send()) {
            //echo 'Email sent.';
        } else {
            //show_error($this->email->print_debugger());
        }
    }
    
    function sendmailreset_manual(){
			/*
			$message = "Line 1\r\nLine 2\r\nLine 3";

			// In case any of our lines are larger than 70 characters, we should use wordwrap()
			$message = wordwrap($message, 70, "\r\n");
			
			// Send
			mail('candradwiprasetyo@gmail.com', 'My Subject', $message);
			
			
			
			$to      = 'candradwiprasetyo@gmail.com';
			$subject = 'the subject';
			$message = 'hello';
			$headers = "From: investas@investasionlinebersama.com\r\n";
			
			$headers .= "Reply-To: bisnisiob@gmail.com\r\n";
			$headers .= "Return-Path: bisnisiob@gmail.com\r\n";
			//$headers .= "CC: sombodyelse@example.com\r\n";
			//$headers .= "BCC: hidden@example.com\r\n";
			
			mail($to, $subject, $message, $headers);
			
			$this->email->set_newline("\r\n");*/
			
			$this->load->library('email');

			$this->email->from('investas@investasionlinebersama.com', 'Your Name');
			$this->email->to('candradwiprasetyo@gmail.com'); 
			//$this->email->cc('another@another-example.com'); 
			//$this->email->bcc('them@their-example.com'); 
			
			$this->email->subject('Email Test');
			$this->email->message('Testing the email class.');	
			$this->email->set_newline("\r\n");
			$this->email->send();
			
			echo $this->email->print_debugger();
						
						 
						   
			  
			    
	}
	
}