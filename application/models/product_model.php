<?php
	
 /**
 * Product Model
 * A class provided some methods to CURD data in talbe fr_product
 * Created on 2014/10/01
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Product_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME 		= 'fr_product';
 	const IMAGE_TABLE 		= 'fr_product_image';
 	const USER_TABLE 		= 'fr_user';
 	const LABEL_TABLE 		= 'fr_label';
 	const PRODUCT_LABEL 	= 'fr_product_label';

 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */

 	const ID          = 'id';
 	const NAME        = 'name';
 	const MID         = 'mid';
 	const THUMB_IMAGE = 'thumb_image';
 	const DESCRIBE    = 'describe';
 	const CRE_DATE    = 'cre_date';
 	const HIT         = 'hit';

 	// protected $fields = array(
 	// 					// 表 $table_name
 	// 					'product_id'		=> 'id'	,			//int 主键 产品id
 	// 					'product_name'		=> 'name',			//string 产品名称
 	// 					'product_describe'	=> 'describe',		//string 描述				error 待修改
 	// 					'product_cre_date'	=> 'cre_date',		//string 创建时间
 	// 					'product_hit'		=> 'hit',			//int
 	// 					'product_mid'		=> 'mid', 			//int 外键 美甲师id
 	// 					// 表 $user_table
 	// 					'm_id'				=> 'id',			//int 美甲师id 
 	// 					'm_name'			=> 'nick_name',		//string 美甲师名称
 	// 					'm_status'			=> 'status',
 	// 					'm_type'			=> 'type',
 	// 					// 表 $image_table
 	// 					'image_uri'			=> 'uri',			//string 产品图片地址
 	// 					'image_pid'			=> 'pid',			//int 外键 产品id 
 	// 					'image_order'		=> 'order'			//int  照片排序 
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
 		$this->load->model('product_image_model');
 		$this->load->model('product_label_model');
 		// $this->load->model('label_model');
 		$this->load->library('IUser');
 		$this->load->library('ILabel');
 		$this->load->library('IProduct');
 		$this->load->library('IPdtImage');
 		$this->load->library('IPdtLabel');
 		// $this->load->model('user_model');
 	}

 	/**
 	 * 获取user表的字段名称
 	 */
 	// function get_fields()
 	// {
 	// 	return $this->fields;
 	// }

 	/**
 	 * Get products list 
 	 * Created on 2014/10/01
 	 * @param int $offset 偏移量
 	 * @param int $limit 数量
 	 * @param int $order 排序
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_product_list($offset = 0, $limit = 10, $order_by = "", $order = "asc")
 	{
 		echo user_model::TABLE_NAME;
 		$select = self::TABLE_NAME.'.'.self::ID.' as '.IProduct::ID.', '.
 					self::TABLE_NAME.'.'.self::NAME.' as '.IProduct::NAME.', '.
 					self::TABLE_NAME.'.'.self::DESCRIBE.' as '.IProduct::DESCRIBE.', '.
 					self::TABLE_NAME.'.'.self::CRE_DATE.' as '.IProduct::CRE_DATE.', '.
 					self::TABLE_NAME.'.'.self::HIT.' as '.IProduct::HIT.', '.
 					self::IMAGE_TABLE.'.'.product_image_model::URI.' as '.IProduct::IMAGE.', '.
 					self::USER_TABLE.'.'.user_model::NICK_NAME.' as '.IUser::NICK_NAME.' '
 					;
 		// 'product.id as id, product.name as name, image.uri as image_uri'
 		$this->db->select($select);
 		$this->db->from(self::TABLE_NAME);
 		$this->db->join(self::IMAGE_TABLE, 
 				self::IMAGE_TABLE.'.'.product_image_model::PID.' = '.self::TABLE_NAME.'.'.self::ID
 				.' and '.self::IMAGE_TABLE.'.'.product_image_model::ORDER.' = 0 ', 'left'
 				);
 		$this->db->join(self::USER_TABLE, 
 				self::TABLE_NAME.'.'.self::MID.' = '.self::USER_TABLE.'.'.user_model::ID
 				.' and '.self::USER_TABLE.'.'.user_model::TYPE.' = 2 '
 				.' and '.self::USER_TABLE.'.'.user_model::STATUS.' = 1 '
 				, 'left'
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
 	 * Get a product info except images
 	 * Created on 2014/10/01
 	 * @param int $product_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_product_info($product_id = 0)
 	{
 		$select = self::TABLE_NAME.'.'.self::ID.' as '.IProduct::ID.', '.
 					self::TABLE_NAME.'.'.self::NAME.' as '.IProduct::NAME.', '.
 					self::TABLE_NAME.'.'.self::DESCRIBE.' as '.IProduct::DESCRIBE.', '.
 					self::TABLE_NAME.'.'.self::CRE_DATE.' as '.IProduct::CRE_DATE.', '.
 					self::TABLE_NAME.'.'.self::HIT.' as '.IProduct::HIT.', '.
 					self::USER_TABLE.'.'.user_model::USER_NAME.' as '.IUser::USER_NAME
 					;
 		$this->db->select($select);
 		$this->db->from(self::TABLE_NAME);
 		$this->db->where(self::TABLE_NAME.'.'.self::ID.' = '.$product_id);
 		$this->db->join(self::USER_TABLE, 
 				self::TABLE_NAME.'.'.self::MID.' = '.self::USER_TABLE.'.'.user_model::ID
 				.' and '.self::USER_TABLE.'.'.user_model::TYPE.' = 2 ', 'left'
 				);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}



 	/**
 	 * Get a product images info
 	 * Created on 2014/10/01
 	 * @param int $product_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_product_images($product_id = 0)
 	{
 		$select = 
 			self::IMAGE_TABLE.'.'.product_image_model::URI.' as '.IProduct::IMAGE;
 		$this->db->select($select);
 		$this->db->from(self::IMAGE_TABLE);
 		$this->db->where(self::IMAGE_TABLE.'.'.product_image_model::PID.' = '.$product_id);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}

}



/* End of file product_model.php */
/* Location: ./application/model/product_model.php */