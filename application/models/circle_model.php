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
 	// protected $table_name = 'fr_circle';
 	// protected $image_table = 'fr_circle_image'; 			// error 待修改
 	// protected $user_table = 'fr_user';
 	// protected $comment_table = 'fr_circle_comment';
 	// protected $product_label = "fr_product_label";

 	const TABLE_NAME 		= 'fr_circle';
 	const IMAGE_TABLE 		= 'fr_circle_image';
 	const USER_TABLE 		= 'fr_user';
 	const COMMENT_TABLE 	= 'fr_circle_comment';


 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */

 	const ID       = 'id';
 	const TITLE    = 'title';
 	const CONTENT  = 'content';
 	const CRE_DATE = 'cre_date';
 	const HIT      = 'hit';
 	const UID      = 'uid';
 	const IMAGE    = 'thumb_image';

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
 						'image_uri'			=> 'uri',			//string 
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
 		$this->load->model('user_model');
 		$this->load->model('circle_comment_model');
 		$this->load->model('circle_image_model');
 		$this->load->library('IUser');
 		$this->load->library('ICircle');
 		$this->load->library('ICirComment');
		$this->load->library('ICirImage');
 		// $this->load->library('IUser');

 	}

 	/**
 	 * 获取circle表及其相关表的字段名称
 	 */
 	// function get_fields()
 	// {
 	// 	return $this->fields;
 	// }

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
 		$select = self::TABLE_NAME.'.'.self::ID.' as '.ICircle::ID.', '.
 					self::TABLE_NAME.'.'.self::TITLE.' as '.ICircle::TITLE.', '.
 					self::TABLE_NAME.'.'.self::CONTENT.' as '.ICircle::CONTENT.', '.
 					self::TABLE_NAME.'.'.self::CRE_DATE.' as '.ICircle::CRE_DATE.', '.
 					self::TABLE_NAME.'.'.self::HIT.' as '.ICircle::HIT.', '.
 					self::TABLE_NAME.'.'.self::UID.' as '.ICircle::UID.', '.
 					self::TABLE_NAME.'.'.self::IMAGE.' as '.ICircle::IMAGE.', '.
 					self::USER_TABLE.'.'.user_model::NICK_NAME.' as '.IUser::NICK_NAME
 					;
 		// 'circle.id as id, circle.name as name, image.uri as image_uri'
 		$this->db->select($select);
 		$this->db->from(self::TABLE_NAME);
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
 		$select = self::TABLE_NAME.'.'.self::ID.' as '.ICircle::ID.', '.
 					self::TABLE_NAME.'.'.self::TITLE.' as '.ICircle::TITLE.', '.
 					self::TABLE_NAME.'.'.self::CONTENT.' as '.ICircle::CONTENT.', '.
 					self::TABLE_NAME.'.'.self::CRE_DATE.' as '.ICircle::CRE_DATE.', '.
 					self::TABLE_NAME.'.'.self::HIT.' as '.ICircle::HIT.', '.
 					self::USER_TABLE.'.'.user_model::NICK_NAME.' as '.IUser::NICK_NAME
 					;
 		$this->db->select($select);
 		$this->db->from(self::TABLE_NAME);
 		$this->db->where(self::TABLE_NAME.'.'.self::ID.' = '.$circle_id);
 		$this->db->join(self::IMAGE_TABLE, 
 				self::IMAGE_TABLE.'.'.circle_image_model::CID.' = '.self::TABLE_NAME.'.'.self::ID
 				, 'left'
 				);
 		$this->db->join(self::USER_TABLE, 
 				self::TABLE_NAME.'.'.self::UID.' = '.self::USER_TABLE.'.'.user_model::ID
 				.' and '.self::USER_TABLE.'.'.user_model::STATUS.' = 1 ', 'left'
 				);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}




 	/**
 	 * Get a circle images info
 	 * Created on 2014/10/01
 	 * @param int $circle_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_circle_images($circle_id = 0)
 	{
 		$select = 
 			self::IMAGE_TABLE.'.'.circle_image_model::URI.' as '.ICircle::IMAGE;
 		$this->db->select($select);
 		$this->db->from(self::IMAGE_TABLE);
 		$this->db->where(self::IMAGE_TABLE.'.'.circle_image_model::CID.' = '.$circle_id);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}

 	/**
 	 * Insert a circle  item 
 	 * Created on 2014/10/15
 	 * @param array $arr =
 	 *				int 		'uid'  				登录id
 	 * 				int 		'' 				圈子id
 	 *				string 		'comments' 					评论内容
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function insert_entry($entry)
 	{
 		$this->db->insert(self::TABLE_NAME, $entry);
 		if($this->db->affected_rows() > 0) {
 			log_message('debug', $this->db->last_query().'; id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 			return $this->db->insert_id();
 		}
 		else {
 			log_message('debug', $this->db->last_query());
 			return FALSE;
 		}
 	}


 }


 /* End of file circle_model.php */
/* Location: ./application/model/circle_model.php */