<?php

class Home_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function is_valid($username, $password)
	{
		$param['user_login'] = $username;
		$param['user_password'] = ($password);
		$param['user_active_status'] = '1';
		
		$query = $this->db->get_where('users u', $param);
		
		# debug($this->db->last_query());

		if ($query->num_rows() == 0) return NULL;
		$data = $query->row_array();
		
		return array($data['user_id'], $data['user_type_id']);
	}
	
	
	function get_page_content($id)
	{
		$sql = "select page_content as result from pages where page_id = '$id'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return $result['result'];
	}
	
	
	
	
	
}