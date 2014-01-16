<?php

class UserModel extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	function getList()
	{
		$query = $this->db->query("select * from user");
		$result = $query->result_array();
		
		return $result;
	}

}