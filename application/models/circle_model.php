<?php
	
 /**
 * Circle Model
 * A class provided some methods to CURD data in talbe fr_circle
 * Created on 2014/10/10
 * @author fanz <2513273451@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Circle_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	protected $table_name = 'fr_circle';
 	protected $image_table = 'fr_circle_image'; 			// error 待修改
 	protected $user_table = 'fr_user';
 	protected $comment_table = 'fr_circle_comment';
 	// protected $product_label = "fr_product_label";


 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */
 	protected $fields = array(
 						// 表 $table_name
 						'circle_id'			=> 'id'	,			//int 主键 圈子id
 						'circle_title'		=> 'title',			//string 圈子名称
 						'circle_content'	=> 'content',		//string 内容
 						'circle_cre_date'	=> 'cre_date',		//string 创建时间
 						'circle_hit'		=> 'hit',			//int
 						'circle_uid'		=> 'uid',			//int
 						// 'mid'				=> 'mid', 			//int 外键 美甲师id
 						// 表 $user_table
 						'user_id'			=> 'id',			//int 用户id 
 						'user_nickname'		=> 'nick_name',		//string 用户名称
 						'user_type'			=> 'type',			//类型
 						'user_status'		=> 'status', 		//状态
 						// 表 $image_table
 						'image_uri'			=> 'uri',			//string 产品图片地址
 						'image_cid'			=> 'cid',			//int 外键 圈子id 
 						'image_order'		=> 'order',			//int  照片排序 
 						// 表 $comment_table
 						'comment_uid'		=> 'uid',			// 用户id
 						'comment_uname'		=> 'nick_name',		// 用户昵称
 						'comment_cid'		=> 'cid',			// 圈子id
 						'comments'			=> 'comments',		// 评论内容
 						'comment_cre_date'	=> 'cre_date'		// 发表时间
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
 	 * Get circle list 
 	 * Created on 2014/10/10
 	 * @param int $offset 偏移量
 	 * @param int $limit 数量
 	 * @param int $order 排序
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_circle_list($offset = 0, $limit = 10, $order_by = "", $order = "desc")
 	{
 		$select = $this->table_name.'.'.$this->fields['circle_id'].' as '.$this->config->item('circle_id').', '.
 					$this->table_name.'.'.$this->fields['circle_title'].' as '.$this->config->item('circle_title').', '.
 					$this->table_name.'.'.$this->fields['circle_content'].' as '.$this->config->item('circle_content').', '.
 					$this->table_name.'.'.$this->fields['circle_cre_date'].' as '.$this->config->item('circle_cre_date').', '.
 					$this->table_name.'.'.$this->fields['circle_hit'].' as '.$this->config->item('circle_hit').', '.
 					$this->image_table.'.'.$this->fields['user_id'].' as '.$this->config->item('u_id').', '.
 					$this->image_table.'.'.$this->fields['image_uri'].' as '.$this->config->item('circle_image').', '.
 					$this->user_table.'.'.$this->fields['user_nickname'].' as '.$this->config->item('u_nickname')
 					;
 		// 'product.id as id, product.name as name, image.uri as image_uri'
 		$this->db->select($select);
 		$this->db->from($this->table_name);
 		$this->db->join($this->image_table, 
 				$this->image_table.'.'.$this->fields['image_cid'].' = '.$this->table_name.'.'.$this->fields['circle_id']
 				.' and '.$this->image_table.'.'.$this->fields['image_order'].' = 0 ', 'left'
 				);
 		$this->db->join($this->user_table, 
 				$this->table_name.'.'.$this->fields['circle_uid'].' = '.$this->user_table.'.'.$this->fields['user_id']
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
 		log_message('debug',$this->db->last_query());
 		// log_message('debug', $this->db->last_query());
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}


 	/**
 	 * Get a circle info except images
 	 * Created on 2014/10/10
 	 * @param int $circle_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_circle_info($circle_id = 0)
 	{
 		$select = $this->table_name.'.'.$this->fields['circle_id'].' as '.$this->config->item('circle_id').', '.
 					$this->table_name.'.'.$this->fields['circle_title'].' as '.$this->config->item('circle_title').', '.
 					$this->table_name.'.'.$this->fields['circle_content'].' as '.$this->config->item('circle_content').', '.
 					$this->table_name.'.'.$this->fields['circle_cre_date'].' as '.$this->config->item('circle_cre_date').', '.
 					$this->table_name.'.'.$this->fields['circle_hit'].' as '.$this->config->item('circle_hit').', '.
 					$this->user_table.'.'.$this->fields['user_nickname'].' as '.$this->config->item('u_nickname')
 					;
 		$this->db->select($select);
 		$this->db->from($this->table_name);
 		$this->db->where($this->table_name.'.'.$this->fields['circle_id'].' = '.$circle_id);
 		$this->db->join($this->image_table, 
 				$this->image_table.'.'.$this->fields['image_cid'].' = '.$this->table_name.'.'.$this->fields['circle_id']
 				, 'left'
 				);
 		$this->db->join($this->user_table, 
 				$this->table_name.'.'.$this->fields['circle_uid'].' = '.$this->user_table.'.'.$this->fields['user_id']
 				.' and '.$this->user_table.'.'.$this->fields['user_status'].' = 1 ', 'left'
 				);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}




 	// /**
 	//  * Get a product images info
 	//  * Created on 2014/10/01
 	//  * @param int $product_id 
 	//  * @return  array 查询成功返回对象数组
 	//  * 			boolean 失败
 	//  */
 	// function get_product_images($product_id = 0)
 	// {
 	// 	$select = 
 	// 		$this->image_table.'.'.$this->fields['image_uri'].' as '.$this->config->item('image_uri');
 	// 	$this->db->select($select);
 	// 	$this->db->from($this->image_table);
 	// 	$this->db->where($this->image_table.'.'.$this->fields['pid'].' = '.$product_id);
 	// 	$res = $this->db->get();
 	// 	if($res->num_rows() >= 1)
 	// 		return $res->result_array();
 	// 	else
 	// 		return FALSE;
 	// }

 }


 /* End of file circle_model.php */
/* Location: ./application/model/circle_model.php */