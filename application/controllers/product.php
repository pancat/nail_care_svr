<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Product controller
 * A class provided some methods about get products list...
 * Created on 2014/10/01
 * @author fanz <2513273451@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class Product extends CI_Controller {

	/**
	 * 数据库字段名($value是数据库中字段的名称)
	 * array(
 	 *					'product_id'		=> 'id'	,			//int 主键 id
 	 *					'product_name'		=> 'name',			//string 产品名称
 	 *					'm_id'				=> 'm_id',			//int 美甲师id
 	 *					'm_name'			=> 'm_name',		//string 美甲师名称
 	 *					'image_uri'			=> 'image_uri',		//string 产品图片地址
 	 *					'cre_date'			=> 'cre_date'		//string 创建时间
 	 *					);
	 */
	protected $db_fields;

	/**
	 * 外部接口字段名($value是外部接口的字段名称)
	 * @dis
	 */
	// protected  $interface_fields = array(
 // 						'product_id'		=> 'product_id'	,	//int 主键 id
 // 						'product_name'		=> 'name',			//string 产品名称
 // 						'm_id'				=> 'm_id',			//int 美甲师id
 // 						'm_name'			=> 'm_name',		//string 美甲师名称
 // 						'image_uri'			=> 'image_uri',		//string 产品图片地址
 // 						'cre_date'			=> 'cre_date',		//string 创建时间
 // 						'res_state'			=> 'res_state',		//int 操作结果：0 (失败) 1(成功)
 // 						'error_code'		=> 'error_code'		//string 错误代码，具体查看接口文档
 // 						);

	function __construct() {
		parent::__construct();
		$this->load->model('product_model');
		$this->load->helper('date');
		$this->db_fields = $this->product_model->get_fields();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	/**
	 * Get products list information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	offset
	 * @param GET 	int 	limit
	 * @param GET 	string 	order
	 * @param GET 	boolean	desc
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_product_list($offset = 0, $limit = 10, $order = "", $desc = false)
	{
		$res = $this->product_model->get_product_list();
		echo json_encode($res);
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}

	/**
	 * Get a product information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	product id
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_product_info($product_id = 0)
	{
		// print_r($this->product_model->get_product_info($product_id));
		$res = $this->product_model->get_product_info($product_id);
		echo json_encode($res);
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}

	/**
	 * Get a product information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	product id
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_product_images($product_id = 0)
	{
		$res = $this->product_model->get_product_images($product_id);
		echo json_encode($res);
	}

	/**
	 * 将从数据库中取得的多个用户的信息进行编码
	 * $data中的字段名称与数据库有关
	 * @author fanz <2513273451@qq.com>
	 * @param array
	 * @return array 
	 * @access private
	 * @todo
	 */
	private function _gen_users_info($datas)
	{
		$arrs = array();
		foreach ($datas as $item) {
			$temp = $this->_gen_user_info($item);
			$arr1 = array($temp['userid'] => $temp);
			$arrs = array_merge($arrs, $arr1);
		}
		return $arrs;
	}

	/**
	 * 验证token
	 * @author fanz <2513273451@qq.com>
	 * @param string $token
	 * @return boolean 
	 * 				true 	token验证合法
	 *				false 	token验证不合法
	 * @todo
	 * @access private
	 */
	private function _token_validation($token) {
		return TRUE;
	}
}

/* End of file product.php */
/* Location: ./application/controllers/product.php */