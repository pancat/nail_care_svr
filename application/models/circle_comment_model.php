<?php
	
 /**
 * Comment Model
 * A class provided some methods to CURD data in talbe fr_circle_comments
 * Created on 2014/10/10
 * @author fanz <2513273451@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Circle_comment_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	protected $table_name = 'fr_circle_comment';
 	protected $user_table = 'fr_user';

 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */
 	protected $fields = array(
 						
 						// 表 $comment_table
		 				'comment_id'		=> 'id',			// 用户id
 						'comment_uid'		=> 'uid',			// 用户id
 						'comment_cid'		=> 'cid',			// 圈子id
 						'comments'			=> 'comments',		// 评论内容
 						'comment_cre_date'	=> 'cre_date',		// 发表时间

 						'user_id'			=> 'id',			//int 用户id 
 						'user_name'			=> 'nick_name',		//string 用户名称
 						// 'user_type'			=> 'type',			//类型
 						'user_status'		=> 'status'			//状态
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
 	 * 获取circle表及其相关表的字段名称
 	 */
 	function get_fields()
 	{
 		return $this->fields;
 	}


 	/**
 	 * Get a circle comments info 
 	 * Created on 2014/10/10
 	 * @param int $circle_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
	function get_circle_comments($circle_id = 0, $offset = 0, $limit = 10, $order_by = "cre_date", $order = "desc")
 	{
		$select = $this->table_name.'.'.$this->fields['comment_id'].' as '.$this->config->item('comment_id').', '.
 					$this->table_name.'.'.$this->fields['comment_cid'].' as '.$this->config->item('comment_cid').', '.
 					$this->table_name.'.'.$this->fields['comments'].' as '.$this->config->item('comments').', '.
 					$this->table_name.'.'.$this->fields['comment_cre_date'].' as '.$this->config->item('comment_cre_date').', '.
 					$this->table_name.'.'.$this->fields['comment_uid'].' as '.$this->config->item('comment_uid').', '.
 					$this->user_table.'.'.$this->fields['user_name'].' as '.$this->config->item('u_nickname')
 					;
 		$this->db->select($select);
 		$this->db->from($this->table_name);
 		$this->db->where($this->table_name.'.'.$this->fields['comment_cid'].' = '.$circle_id);
 		$this->db->join($this->user_table, 
 				$this->table_name.'.'.$this->fields['comment_uid'].' = '.$this->user_table.'.'.$this->fields['user_id']
 				.' and '.$this->user_table.'.'.$this->fields['user_status'].' = 1 ', 'left'
 				);

 		$this->db->limit($limit,$offset);
 		if($order_by != "" && $this->db->field_exists($order_by, $this->table_name))
 			$this->db->order_by($order_by, $order);
 		else {
 			if(!$this->db->field_exists($order_by, $this->table_name))
 				log_message('debug', 'The field : '.$order_by.' is not exists in table '.$this->table_name);
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
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function insert_entry($arr)
 	{
 		$this->db->insert($this->table_name, $arr);
 		log_message('debug', $this->db->last_query().'; comment_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
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
 	function delete_entry($comment_id)
 	{
 		$this->db->delete($this->table_name, $arr);
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
 		$this->db->delete($this->table_name, $arr);
 		log_message('debug', $this->db->last_query().'; comment_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}


 }


 /* End of file circle_comment_model.php */
/* Location: ./application/model/circle_comment_model.php */