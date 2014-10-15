<?php
	
 /**
 * Session Model
 * A class provided some methods to CURD data in talbe fr_session
 * Created on 2014/10/14
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */

class Session_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME = 'fr_session';

 	/**
 	 * 表字段名称
 	 */
 	const SESSION_ID = 'sessionid';
 	const USER_ID	 = 'uid';
 	const LAST_DATE	 = 'last_date';

 	function __construct() 
 	{
 		parent::__construct();
 	}

 	function insert_userdata($arr)
 	{
 		$this->db->insert(self::TABLE_NAME, $arr);
 		log_message('debug', $this->db->last_query().'; sessionid: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}

 	function update_userdata($arr)
 	{
 		$data = array_chunk($arr,2,true);
 		$this->db->where($data[0])->update(self::TABLE_NAME, $data[1]);
 		log_message('debug', $this->db->last_query().'; sessionid: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}


 	function is_login($arr)
 	{
 		$res = $this->db->select()->from(self::TABLE_NAME)->where($arr)->get();
 		if($res->num_rows() >= 1)
 			return TRUE;
 		else
 			return FALSE;
 	}

 	function del_item($arr)
 	{
 		$this->db->delete(self::TABLE_NAME, $arr);
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}

}



/* End of file session_model.php */
/* Location: ./application/model/session_model.php */