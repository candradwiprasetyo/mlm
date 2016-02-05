<?php

class Register_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	
	function read_slider_id($id)
	{
		$this->db->select('a.*', 1); // ambil seluruh data
		$this->db->where('a.slider_id', $id);
		$query = $this->db->get('sliders a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	function read_feature_id($id)
	{
		$this->db->select('a.*', 1); // ambil seluruh data
		$this->db->where('a.feature_id', $id);
		$query = $this->db->get('features a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	
	function create_user($data){
		$this->db->trans_start();
		$this->db->insert('users', $data);
		$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		return $id;
	}
	
	function create_reveral($reveral_id, $user_id, $level){
		$this->db->trans_start();
		
		$data['reveral_id']	= $reveral_id;
		$data['user_id']	= $user_id;
		$data['level']		= $level;
		if($level == 1 || $level == 5){
			$data['transfer']		= 50000;
		}else{
			$data['transfer']		= 10000;
		}
		$this->db->insert('member_reverals', $data);
		$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		return $id;
	}

	function get_project_img($limit)
	{
		$sql = "select feature_img from features  order by feature_id limit $limit
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['feature_img'];
	}
	
	function get_project_id($limit)
	{
		$sql = "select feature_id from features  order by feature_id limit $limit
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['feature_id'];
	}
	
	function get_reveral($id)
	{
		$sql = "select reveral_id as result from users where user_id = '$id'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['result'];
	}
	
	function get_exist_login($login)
	{
		$sql = "select count(user_id) as result from users where user_login = '$login'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return ($result['result']) ? $result['result'] : 0;
	}
	
	function get_exist_username($username)
	{
		$sql = "select count(user_id) as result from users where user_code = '$username'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return ($result['result']) ? $result['result'] : 0;
	}

	function get_user_id($username)
	{
		$sql = "select user_id as result from users where user_code = '$username'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return $result['result'];
	}
	
	function update_password($email, $password){

		$this->db->trans_start();
		$data['user_password'] = ($password);
		$this->db->where('user_login', $email);
		$this->db->update('users', $data);
	
		$this->db->trans_complete();
		//return $id;
	}
	
	
}