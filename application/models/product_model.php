<?php
	
 /**
 * Product Model
 * A class provided some methods to CURD data in talbe fr_product
 * Created on 2014/10/01
 * @author fanz <2513273451@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Product_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	protected $table_name = 'fr_product';
 	protected $image_table = 'fr_product_image';
 	protected $user_table = 'fr_user';
 	protected $label_table = 'fr_label';
 	protected $product_label = "fr_product_label";


 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */
 	protected $fields = array(
 						// 表 $table_name
 						'product_id'		=> 'id'	,			//int 主键 产品id
 						'product_name'		=> 'name',			//string 产品名称
 						'product_describe'	=> 'describe',		//string 描述				error 待修改
 						'product_cre_date'	=> 'cre_date',		//string 创建时间
 						'product_hit'		=> 'hit',			//int
 						'product_mid'		=> 'mid', 			//int 外键 美甲师id
 						// 表 $user_table
 						'm_id'				=> 'id',			//int 美甲师id 
 						'm_name'			=> 'nick_name',		//string 美甲师名称
 						'm_status'			=> 'status',
 						'm_type'			=> 'type',
 						// 表 $image_table
 						'image_uri'			=> 'uri',			//string 产品图片地址
 						'image_pid'			=> 'pid',			//int 外键 产品id 
 						'image_order'		=> 'order'			//int  照片排序 
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
 		$select = $this->table_name.'.'.$this->fields['product_id'].' as '.$this->config->item('product_id').', '.
 					$this->table_name.'.'.$this->fields['product_name'].' as '.$this->config->item('product_name').', '.
 					$this->table_name.'.'.$this->fields['product_describe'].' as '.$this->config->item('product_describe').', '.
 					$this->table_name.'.'.$this->fields['product_cre_date'].' as '.$this->config->item('product_cre_date').', '.
 					$this->table_name.'.'.$this->fields['product_hit'].' as '.$this->config->item('product_hit').', '.
 					$this->image_table.'.'.$this->fields['image_uri'].' as '.$this->config->item('product_image').', '.
 					$this->user_table.'.'.$this->fields['m_name'].' as '.$this->config->item('m_name')
 					;
 		// 'product.id as id, product.name as name, image.uri as image_uri'
 		$this->db->select($select);
 		$this->db->from($this->table_name);
 		$this->db->join($this->image_table, 
 				$this->image_table.'.'.$this->fields['image_pid'].' = '.$this->table_name.'.'.$this->fields['product_id']
 				.' and '.$this->image_table.'.'.$this->fields['image_order'].' = 0 ', 'left'
 				);
 		$this->db->join($this->user_table, 
 				$this->table_name.'.'.$this->fields['product_mid'].' = '.$this->user_table.'.'.$this->fields['m_id']
 				.' and '.$this->user_table.'.'.$this->fields['m_type'].' = 2 '
 				.' and '.$this->user_table.'.'.$this->fields['m_status'].' = 1 '
 				, 'left'
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
 	 * Get a product info except images
 	 * Created on 2014/10/01
 	 * @param int $product_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_product_info($product_id = 0)
 	{
 		$select = $this->table_name.'.'.$this->fields['product_id'].' as '.$this->config->item('product_id').', '.
 					$this->table_name.'.'.$this->fields['product_name'].' as '.$this->config->item('product_name').', '.
 					$this->table_name.'.'.$this->fields['product_describe'].' as '.$this->config->item('product_describe').', '.
 					$this->table_name.'.'.$this->fields['product_cre_date'].' as '.$this->config->item('product_cre_date').', '.
 					$this->table_name.'.'.$this->fields['product_hit'].' as '.$this->config->item('product_hit').', '.
 					$this->user_table.'.'.$this->fields['m_name'].' as '.$this->config->item('m_name')
 					;
 		$this->db->select($select);
 		$this->db->from($this->table_name);
 		$this->db->where($this->table_name.'.'.$this->fields['product_id'].' = '.$product_id);
 		$this->db->join($this->user_table, 
 				$this->table_name.'.'.$this->fields['product_mid'].' = '.$this->user_table.'.'.$this->fields['m_id']
 				.' and '.$this->user_table.'.'.$this->fields['m_type'].' = 2 ', 'left'
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
 			$this->image_table.'.'.$this->fields['image_uri'].' as '.$this->config->item('product_image');
 		$this->db->select($select);
 		$this->db->from($this->image_table);
 		$this->db->where($this->image_table.'.'.$this->fields['image_pid'].' = '.$product_id);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}

 }


 /* End of file product_model.php */
/* Location: ./application/model/product_model.php */