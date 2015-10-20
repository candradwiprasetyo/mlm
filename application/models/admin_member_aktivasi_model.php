<?php

class admin_member_aktivasi_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function list_data() {
		$query = "select a.*, b.*, c.city_name
					from member_activations a
					join users b on b.user_id = a.user_id
					left join cities c on c.city_id = b.city_id
					where status = 0
					order by member_activation_id 
					";
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
		$this->db->select('a.*, b.*, c.city_name', 1); // ambil seluruh data
		$this->db->where('a.member_activation_id', $id);
		$this->db->join('users b', 'b.user_id = a.user_id');
		$this->db->join('cities c', 'c.city_id = b.city_id', 'left');
		$query = $this->db->get('member_activations a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	


	function update($data, $id, $user_id){

		$this->db->trans_start();
		$this->db->where('member_activation_id', $id);
		$this->db->update('member_activations', $data);
		
		$data_user['activation_status'] = 1;
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data_user);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function get_user_id($id){



		$sql = "select user_id as result from member_activations where member_activation_id = '$id'";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['result'];
	
		

	}	

	
}