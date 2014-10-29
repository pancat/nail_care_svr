<?php
	
 /**
 * Product image Model
 * A class provided some methods to CURD data in talbe fr_product_image
 * Created on 2014/10/15
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Product_image_model extends CI_Model {

 	const TABLE_NAME 	= 'fr_product_image';


 	const ID 		= 'id';
 	const URI 		= 'uri';
 	const HEIGHT 	= 'height';
 	const WIDTH 	= 'width';
 	const PID 		= 'pid';
 	const ORDER 	= 'order';

 	function __construct() 
 	{
 		parent::__construct();
 	}

 	/**
 	 * Insert a product item 
 	 * Created on 2014/10/15
 	 * @param array $arr =
 	 *				int 		'mid'  				登录id
 	 * @return  int 	 	id 		插入数据的id
 	 * 			boolean 	false 	失败
 	 */
 	function insert_entry($entry) {
 		$this->db->insert(self::TABLE_NAME, $entry);
 		if($this->db->affected_rows() > 0) {
 			log_message('debug', $this->db->last_query());
 			return $this->db->insert_id();
 		}
 		else {
 			log_message('debug', $this->db->last_query());
 			return FALSE;
 		}
 	}


 }



/* End of file product_model.php */
/* Location: ./application/model/product_model.php */