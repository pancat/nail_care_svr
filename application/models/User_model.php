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
 	 *				string 'username'  登录用户名
 	 * 				string 'psd' 登录密码 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_user($arr)
 	{
 		$res = $this->db->where($arr)->get($this->table_name);
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
 	function insert_entry()
 	{

 	}

 	function update_entry()
 	{

 	}


 }


 /* End of file User_model.php */
/* Location: ./application/model/User_model.php */