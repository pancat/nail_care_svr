<?php
	
 /**
 * Comment Model
 * A class provided some methods to CURD data in talbe fr_circle_comments
 * Created on 2014/10/10
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */

                  
 class Circle_comment_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
	const TABLE_NAME = 'fr_circle_comment';
 	const USER_TABLE = 'fr_user';

 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */
 	const ID       = 'id';
 	const UID      = 'uid';
 	const CID      = 'cid';
 	const COMMENTS = 'comments';
 	const CRE_DATE = 'cre_date';

 	// protected $fields = array(
 						
 	// 					// 表 $comment_table
		//  				'comment_id'		=> 'id',			// 用户id
 	// 					'comment_uid'		=> 'uid',			// 用户id
 	// 					'comment_cid'		=> 'cid',			// 圈子id
 	// 					'comments'			=> 'comments',		// 评论内容
 	// 					'comment_cre_date'	=> 'cre_date',		// 发表时间

 	// 					'user_id'			=> 'id',			//int 用户id 
 	// 					'user_name'			=> 'nick_name',		//string 用户名称
 	// 					// 'user_type'			=> 'type',			//类型
 	// 					'user_status'		=> 'status'			//状态
 	// 					);

 	/**
 	 * 软删除，仅修改字段status为“被删除”状态。
 	 * @var bool
 	 */
 	protected $soft_delete = TRUE;

 	function __construct() 
 	{
 		parent::__construct();
 		$this->load->model('user_model');
 		$this->load->library('ICirComment');
 		$this->load->library('IUser');
 	}

 	// /**
 	//  * 获取circle表及其相关表的字段名称
 	//  */
 	// function get_fields()
 	// {
 	// 	return $this->fields;
 	// }


 	/**
 	 * Get a circle comments info 
 	 * Created on 2014/10/10
 	 * @param int $circle_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
	function get_circle_comments($circle_id = 0, $offset = 0, $limit = 10, $order_by = "cre_date", $order = "desc")
 	{
		$select =   self::TABLE_NAME.'.'.self::ID.' as '.ICirComment::ID.', '.
 					self::TABLE_NAME.'.'.self::CID.' as '.ICirComment::CID.', '.
 					self::TABLE_NAME.'.'.self::COMMENTS.' as '.ICirComment::COMMENTS.', '.
 					self::TABLE_NAME.'.'.self::CRE_DATE.' as '.ICirComment::CRE_DATE.', '.
 					self::TABLE_NAME.'.'.self::UID.' as '.ICirComment::UID.', '.
 					self::USER_TABLE.'.'.user_model::USER_NAME.' as '.IUser::NICK_NAME
 					;
 		$this->db->select($select);
 		$this->db->from(self::TABLE_NAME);
 		$this->db->where(self::TABLE_NAME.'.'.self::CID.' = '.$circle_id);
 		$this->db->join(self::USER_TABLE, 
 				self::TABLE_NAME.'.'.self::UID.' = '.self::USER_TABLE.'.'.user_model::ID
 				.' and '.self::USER_TABLE.'.'.user_model::STATUS.' = 1 ', 'left'
 				);

 		$this->db->limit($limit,$offset);
 		if($order_by != "" && $this->db->field_exists($order_by, self::TABLE_NAME))
 			$this->db->order_by($order_by, $order);
 		else {
 			if(!$this->db->field_exists($order_by, self::TABLE_NAME))
 				log_message('debug', 'The field : '.$order_by.' is not exists in table '.self::TABLE_NAME);
 		}
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}

 	/**
 	 * Insert a circle's comment item 
 	 * Created on 2014/9/25
 	 * @param array $arr =
 	 *				int 		'comment_uid'  				登录id
 	 * 				int 		'comment_cid' 				圈子id
 	 *				string 		'comments' 					评论内容
 	 * @return  int 		id 		插入数据成功,返回数据id
 	 * 			boolean 	false 	失败
 	 */
 	function insert_entry($arr)
 	{
 		$this->db->insert(self::TABLE_NAME, $arr);
 		log_message('debug', $this->db->last_query().'; comment_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return $this->db->insert_id();
 		else
 			return FALSE;
 	}


 	/**
 	 * Delete a comment item 
 	 * Created on 2014/10/14
 	 * @param array $arr =
 	 *				int 		'comment_uid'  				评论id
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function delete_entry($arr)
 	{
 		$this->db->delete(self::TABLE_NAME, $arr);
 		log_message('debug', $this->db->last_query().'; comment_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}

 	/**
 	 * Delete all comments of a circle
 	 * Created on 2014/10/14
 	 * @param array $arr =
 	 * 				int 		'comment_cid' 				圈子id
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function delete_entries_by_cid($comment_id)
 	{
 		$this->db->delete(self::TABLE_NAME, $arr);
 		log_message('debug', $this->db->last_query().'; comment_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}


 }


 /* End of file circle_comment_model.php */
/* Location: ./application/model/circle_comment_model.php */