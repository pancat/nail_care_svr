<?php
	
 /**
 * Admin Model
 * A class provided some methods to CURD data in talbe fr_user
 * Created on 2014/10/16
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */

  class Admin_model extends CI_Model {

  	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME 		= 'admin';


 	const ID 		 		= 'id';
 	const USER_NAME 		= 'user_name';
 	const NICK_NAME 		= 'nick_name';
 	const PSD 				= 'psd';
 	const LEVEL 			= 'level';


 	/**
 	 * 软删除，仅修改字段status为“被删除”状态。
 	 * @var bool
 	 */
 	protected $soft_delete = TRUE;


 	function __construct() 
 	{
 		parent::__construct();
 	}


 	/**
 	 * Insert a admin item 
 	 * Created on 2014/10/16
 	 * @param array $arr =
 	 *				string 		'user_name'  		登录用户名
 	 * 				string 		'psd' 				登录密码
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function insert_entry($arr)
 	{
 		$this->db->insert(self::TABLE_NAME, $arr);
 		log_message('debug', $this->db->last_query());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}


 	/**
 	 * Get a user item 
 	 * Created on 2014/9/25
 	 * @param array $arr =
 	 *				string 		'user_name'  	登录用户名
 	 * 				string 		'psd' 			登录密码 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_admin_by_np($arr)
 	{
 		$res = $this->db->where($arr)->get(self::TABLE_NAME);
 		if($res->num_rows() >= 1)
 			return $res->row_array();
 		else
 			return FALSE;
 	}

 	

  }
