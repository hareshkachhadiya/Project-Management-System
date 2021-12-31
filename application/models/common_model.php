<?php
class common_model extends CI_Model{
	function insertData($tablename,$store){
		$this->db->insert($tablename,$store);
		return $this->db->insert_id();
	}

	function updateData($tableName, $updateArr, $whereArr){
	    $this->db->where($whereArr);
	    $this->db->update($tableName, $updateArr);
	}

	function deleteData($tableName, $deleteArr){
		$this->db->where($deleteArr);
		$this->db->delete($tableName);
	}

	function getData($tableName, $whereArr='', $limit = '',$offset ='', $orderBy = '', $groupBy = '', $customWhere = ''){
	    $this->db->select('*');
	    $this->db->from($tableName);
	    if (!empty($whereArr)) {
	        $this->db->where($whereArr);
	    }
	    if(!empty($customWhere)){
	        $this->db->where($customWhere);   
	    }
		if (!empty($limit)) {
	        $this->db->limit($limit,$offset);
	    }
	    if (!empty($groupBy)) {
	        $this->db->group_by($groupBy);
	    }
	    if (!empty($orderBy)) {
	        $this->db->order_by($orderBy[0], $orderBy[1]);
	    }
	    $query = $this->db->get();
	    if ($query) {
	        return $query->result();
	    } else {
	        return false;
	    }
	}
	function coreQuery($query){
		$result = $this->db->query($query);
		return $result->result_array();
	}

	function coreQueryObject($query){
		$result = $this->db->query($query);
		return $result->result();
	}	
}
?>