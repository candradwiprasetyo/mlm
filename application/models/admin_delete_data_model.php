<?php

class Admin_delete_data_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function delete(){

		$this->db->trans_start();
		
		$this->db->where('user_type_id', 2);
		$this->db->delete('users');
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
		
	}
	
	function delete_detail(){

		$this->db->trans_start();
		
		$this->db->empty_table('testimonials'); 
		$this->db->empty_table('member_activations'); 
		$this->db->empty_table('member_reverals'); 
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
		
	}
	

	
}