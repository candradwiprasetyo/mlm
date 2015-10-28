<?php

class admin_member_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function list_data() {
		$query = "select a.*, b.city_name
					from users a 
					left join cities b on b.city_id = a.city_id
					where user_type_id  = 2
					order by a.user_id";
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
		$this->db->join('cities b', 'b.city_id = a.city_id', 'left');
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
	
	function nonactive_member($id){

		$this->db->trans_start();
		$data['user_active_status'] = 0;
		$this->db->where('user_id', $id);
		$this->db->update('users', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function active_member($id){

		$this->db->trans_start();
		$data['user_active_status'] = 1;
		$this->db->where('user_id', $id);
		$this->db->update('users', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
}