<?php
	
 /**
 * User Model
 * A class provided some methods to CURD data in talbe fr_user
 * Created on 2014/9/25
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class User_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME 		= 'user';


 	const ID 		 		= 'id';
 	const USER_NAME 		= 'user_name';
 	const PSD 				= 'password';
 	const NICK_NAME 		= 'nick_name';
 	const AGE 				= 'age';
 	const EMAIL 		 	= 'email';
	const ADDR 		 		= 'address';
 	const AVATAR_URI 		= 'avatar_uri';
 	const REGISTER_DATE 	= 'register_date';
 	const LAST_LOGIN 		= 'last_login';
 	const TYPE 				= 'type';
 	const STATUS 			= 'status';
 	const LEVEL 			= 'level';
 	const REMARK 			= 'remark';


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
 	 * 设置为绝对删除
 	 */
 	function set_absolute_delete()
 	{
 		$this->soft_delete = FALSE;
 	}

 	function set_soft_delete()
 	{
 		$this->soft_delete = TRUE;
 	}

 	/**
 	 * Get a user item 
 	 * Created on 2014/9/25
 	 * @param array $arr =
 	 *				string 		'username'  	登录用户名
 	 * 				string 		'psd' 			登录密码 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_user_by_np($arr)
 	{
 		$res = $this->db->where($arr)->get(self::TABLE_NAME);
 		if($res->num_rows() >= 1)
 			return $res->row_array();
 		else
 			return FALSE;
 	}

 	/**
 	 * Get a user item 
 	 * Created on 2014/9/28
 	 * @param array $arr =
 	 *				string 		'username'  	登录用户名
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean false 失败
 	 */
 	function get_user_by_uname($arr)
 	{
 		$res = $this->db->where($arr)->get(self::TABLE_NAME);
 		log_message('debug', $this->db->last_query());
 		if($res->num_rows() >= 1)
 			return $res->row_array();
 		else
 			return FALSE;
 	}

 	/**
 	 * Get a user item 
 	 * Created on 2014/9/28
 	 * @param array $arr =
 	 *				int 		'id'  	用户id
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_user_by_id($arr)
 	{
 		$res = $this->db->where($arr)->get(self::TABLE_NAME);
 		log_message('debug', $this->db->last_query());
 		if($res->num_rows() >= 1)
 			return $res->row_array();
 		else
 			return FALSE;
 	}


 	// just for test
 	function get_all_users()
 	{
 		return $this->db->get(self::TABLE_NAME)->result();
 	}

 	/**
 	 * Insert a user item 
 	 * Created on 2014/9/25
 	 * @param array $arr =
 	 *				string 		'username'  		登录用户名
 	 * 				string 		'psd' 				登录密码
 	 *				timestamp 	'register_date' 	注册时间
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
 	 * @param int $id
 	 * @param array $arr =
 	 *				string 		'username'  		登录用户名
 	 * 				string		'nick_name'			昵称
 	 *				int 		'gender'			性别
 	 *				int 		'age'				年龄				
 	 *				string 		'email'				email
 	 *
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function update_entry($id, $arr)
 	{
 		$this->db->where(self::ID,$id);
 		$this->db->update(self::TABLE_NAME, $arr);
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else 
 			return FALSE;
 	}

 	/**
 	 * update a user's info 
 	 * Created on 2014/9/25
 	 * @param int $id
 	 * @return  None
 	 */
 	function update_login($id)
 	{
 		$arr = array(
 				self::LAST_LOGIN=>now(),
 				self::LAST_IP=>$this->input->ip_address
 				);
 		$this->db->where(self::ID);
 		$this->db->update(self::ID, $id);
 		if($this->db->affected_rows() > 0)
 			log_message('info','user '.$id.' login success with ip address: '.$arr[self::LAST_IP]);
 		else
 			log_message('error','user '.$id.' login success but update uncorrect with ip address: '.$arr[self::LAST_IP]);
 	}

 }


 /* End of file User_model.php */
/* Location: ./application/model/User_model.php */