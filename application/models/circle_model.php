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
 	const WIDTH    = 'width';
 	const HEIGHT    = 'height';

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
 	 * Insert a circle  item 
 	 * Created on 2014/10/15
 	 * @param array $arr =
 	 *				int 		'uid'  				登录id
 	 * 				int 		'' 				圈子id
 	 *				string 		'comments' 					评论内容
 	 * @return  int 	 	id 		插入数据的id
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


 	function update_entry($circle_id, $entry)
 	{
 		$this->db->where(self::ID, $circle_id);
 		$this->db->update(self::TABLE_NAME, $entry);
 		if($this->db->affected_rows() >= 0)
 			return TRUE;
 		else
 			return FALSE;
 	}

 	function circle_exist($arr) 
 	{
 		$this->db->where($arr);
 		$res = $this->db->get(self::TABLE_NAME);
 		if($res->num_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}


 }


 /* End of file circle_model.php */
/* Location: ./application/model/circle_model.php */