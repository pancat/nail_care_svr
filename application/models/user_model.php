<?php
	
 /**
 * User Model
 * A class provided some methods to CURD data in talbe fr_user
 * Created on 2014/9/25
 * @author fanz <2513273451@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class User_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	protected $table_name = 'user';

 	/**
 	 * 表字段的名称
 	 * @var array
 	 */
 	protected $fields = array(
 						'user_id'			=> 'id'	,			//int 主键 id
 						'user_name'			=> 'user_name',		//string 登录用户名
 						'psd'				=> 'password',		//string 登录密码
 						'nick_name'			=> 'nick_name',		//string 昵称
 						'age'				=> 'age',			//int 年龄
 						'email'				=> 'email',			//string 邮箱
 						'address'			=> 'address',		//string 地址
 						'avatar_uri'		=> 'avatar_uri',	//string 头像uri
 						'register_date'		=> 'register_date', //string 注册时间
 						'last_login'		=> 'last_login', 	//string 最近登录时间
 						'last_ip'			=> 'last_ip',		//string 最近登录ip
 						'status'			=> 'status',		//int 状态：1（正常），0（冻结），-1（删除）
 						'level'				=> 'level',			//int 等级：1（普通用户）...
 						'remark'			=> 'remark'			//string 备注
 						);
 	
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
 	 * 获取user表的字段名称
 	 */
 	function get_fields()
 	{
 		return $this->fields;
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
 		$res = $this->db->where($arr)->get($this->table_name);
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
 		$res = $this->db->where($arr)->get($this->table_name);
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
 		$res = $this->db->where($arr)->get($this->table_name);
 		log_message('debug', $this->db->last_query());
 		if($res->num_rows() >= 1)
 			return $res->row_array();
 		else
 			return FALSE;
 	}


 	// just for test
 	function get_all_users()
 	{
 		return $this->db->get($this->table_name)->result();
 	}

 	/**
 	 * Get a user item 
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
 		$this->db->insert($this->table_name, $arr);
 		log_message('debug', $this->db->last_query().'; user_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
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
 		$this->db->where($this->fields['user_id'],$id);
 		$this->db->update($this->table_name, $arr);
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
 				$this->fields['last_login']=>now(),
 				$this->fields['last_ip']=>$this->input->ip_address
 				);
 		$this->db->where($this->fields['user_id']);
 		$this->db->update($this->fields['user_id'], $id);
 		if($this->db->affected_rows() > 0)
 			log_message('info','user '.$id.' login success with ip address: '.$arr[$this->fields['last_ip']]);
 		else
 			log_message('error','user '.$id.' login success but update uncorrect with ip address: '.$arr[$this->fields['last_ip']]);
 	}

 }


 /* End of file User_model.php */
/* Location: ./application/model/User_model.php */