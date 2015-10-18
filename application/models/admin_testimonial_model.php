<?php

class admin_testimonial_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function list_data() {
		$query = "select a.*, b.user_name, b.user_img
					from testimonials a
					left join users b on b.user_id = a.user_id
					order by testimonial_id";
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
		$this->db->select('a.*', 1); // ambil seluruh data
		$this->db->where('a.testimonial_id', $id);
		$query = $this->db->get('testimonials a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	
	
	function create($data){

		$this->db->trans_start();
		$this->db->insert('testimonials', $data);
		$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		return $id;
	}

	function update($data, $id){

		$this->db->trans_start();
		$this->db->where('testimonial_id', $id);
		$this->db->update('testimonials', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function active($id){

		$this->db->trans_start();
		
		$data['testimonial_status'] = 1; 
		$this->db->where('testimonial_id', $id);
		$this->db->update('testimonials', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function non_active($id){

		$this->db->trans_start();
		
		$data['testimonial_status'] = 0; 
		$this->db->where('testimonial_id', $id);
		$this->db->update('testimonials', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function delete($id){

		$this->db->trans_start();
		$this->db->where('testimonial_id', $id);
		$this->db->delete('testimonials');
		$this->db->trans_complete();
		
	}

	function get_img($table, $column, $param){



		$sql = "select $column as result from $table where $param";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['result'];
	
		

	}	
	
}