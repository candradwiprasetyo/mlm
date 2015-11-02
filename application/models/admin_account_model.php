<?php

class Admin_account_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function list_data() {
		$query = "select * from pages order by page_id asc";
        $query = $this->db->query($query);
       // query();
        if ($query->num_rows() == 0)
            return array();
        $data = $query->result_array();
        foreach ($data as $index => $row) {}
        return $data;
	}

	function read_id($id)
	{
		$this->db->select('a.*, b.city_name', 1); // ambil seluruh data
		$this->db->join('cities b', 'b.city_id = a.city_id');
		$this->db->where('a.user_id', $id);
		$query = $this->db->get('users a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	function read_activation_id($id)
	{
		$this->db->select('a.*', 1); // ambil seluruh data
		$this->db->where('a.user_id', $id);
		$query = $this->db->get('member_activations a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	
	
	function create($data){

		$this->db->trans_start();
		$this->db->insert('member_activations', $data);
		$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		return $id;
	}

	function update($data, $id){

		$this->db->trans_start();
		$this->db->where('member_activation_id', $id);
		$this->db->update('member_activations', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function withdraw($id){

		$this->db->trans_start();
		$this->db->where('reveral_id', $id);
		$data['status'] = 1;
		$this->db->update('member_reverals', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function get_page_name($id)
	{
		$sql = "select page_name as result from pages where page_id = '$id'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return $result['result'];
	}
	
	function get_my_transfer($id)
	{
		$sql = "select sum(a.transfer) as result 
				from member_reverals a 
				join users b on b.user_id = a.user_id
				where a.reveral_id = '$id' and status = '1' and b.activation_status = '1'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return ($result['result']) ? $result['result'] : 0;
	}
	
	function get_new_transfer($id)
	{
		$sql = "select sum(a.transfer) as result 
				from member_reverals a 
				join users b on b.user_id = a.user_id
				where a.reveral_id = '$id' and status = '0' and b.activation_status = '1'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return ($result['result']) ? $result['result'] : 0;
	}
	
	function get_total_transfer($id)
	{
		$sql = "select sum(a.transfer) as result 
				from member_reverals a 
				join users b on b.user_id = a.user_id
				where a.reveral_id = '$id' and b.activation_status = '1'
				";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		
		return ($result['result']) ? $result['result'] : 0;
	}
	
	function get_img($table, $column, $param){



		$sql = "select $column as result from $table where $param";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['result'];
	
		

	}	
	
	function get_username($id){



		$sql = "select user_code as result from users where user_id = '$id'";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['result'];
	
		

	}	
}