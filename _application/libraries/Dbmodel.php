<?php
	class Dbmodel {

		private $select = array();
		private $from = '';
		private $where = '';
		private $order_by = '';
		private $limit = '';
		private $offset = '';
		private $is_single_row = false;

		public function __construct() {
			$this->ci =& get_instance();
		}

		public function insert($table, $data) {
			$this->ci->db->insert($table, $data);
			$insert_id = $this->ci->db->insert_id();
			if ($insert_id){
				return $insert_id;
			}else{
				return false;
			}
		}
 
		public function delete($data,$col, $id) {
			$this->ci->db->where($col, $id);
			$state = $this->ci->db->delete($data);
			if ($state){
				return $state;
			}else{
				return false;
			}
		}

		public function update($data, $table, $col, $id) {
		    $this->ci->db->where($col, $id);
			$state=$this->ci->db->update($table, $data);
			if ($state){
				return $state;
			}else{
				return false;
			} 
		}

		public function select($data) {
			$this->select = $data;
			return $this;
		}

		public function from($from) {
			$this->from = $from;

			return $this;
		}

		public function where($where) {
			$this->where = $where;

			return $this;
		}

		public function order_by($order_by) {
			$this->order_by = $order_by;

			return $this;
		}

		public function limit($limit) {
			$this->limit = $limit;

			return $this;
		}

		public function offset($offset) {
			$this->offset = $offset;

			return $this;
		}

		public function is_single_row($is_single_row) {
			$this->is_single_row = $is_single_row;

			return $this;
		}

		public function execute() {
			if($this->select != "*")
				$this->ci->db->select($this->ci->common_function->convert_to_arr($this->select));
			else 
				$this->ci->db->select($this->select);

			$this->ci->db->from($this->from);

			if(!empty($this->where))
				$this->ci->db->where($this->where);

			if(!empty($this->order_by))
	   			$this->ci->db->order_by($this->order_by);
			
			if(!empty($this->group_by))
				$this->ci->db->group_by($this->group_by);
			
			if(!empty($this->limit))  {
				$this->ci->db->limit($this->limit, $this->offset);
			}

	   		$r = $this->ci->db->get();

	   		if(!$this->is_single_row) {
	   			$this->release();

	   			return $r->result_array();
	   		}
	   		else {
	   			$data = $r->result_array();

	   			$this->release();
	   			
	   			return count($data) > 0 ? $data[0] : array();
	   		}
		}

		private function release() {	
			$this->select = array();
			$this->from = '';
			$this->where = '';
			$this->order_by = '';
			$this->limit = '';
			$this->offset = '';
			$this->is_single_row = false;
		}

	}
?>