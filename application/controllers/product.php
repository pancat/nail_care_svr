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

	function __construct() {
		parent::__construct();
		$this->load->model('product_model');
		$this->load->helper('date');
	}

	public function index()
	{
		echo anchor(site_url('product/get_product_list')).'<br>';
		echo anchor(site_url('product/get_product_info/1')).'<br>';
		echo anchor(site_url('product/get_product_images/1')).'<br>';
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
	function get_product_list($offset = 0, $limit = 10, $order_by = "", $order = "desc")
	{
		$res = $this->product_model->get_product_list($offset, $limit, $order_by, $order);
		echo json_encode($res);
	}


	function get_home_ad_list()
	{
		// echo json_encode(array(1=>"123"));
		$res = $this->product_model->get_home_ad_list();
		echo json_encode($res);
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
		$res = $this->product_model->get_product_info($product_id);
		echo json_encode($res);
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
		// header($this->config->item("header_json_utf8")); 
		echo json_encode($res);
	}

	/**
	 * Get all product labels
	 * @author fanz <2513273451@qq.com>
	 * @param  NULL
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_all_labels()
	{
		$this->load->model('label_model');
		$res = $this->label_model->get_all_labels();
		echo json_encode($res);
	}


	function search()
	{
		$like = $this->input->post('like');
		$labels = $this->input->post('labels');
		// $like = 'eetasd';
		// $labels = '';
		if($labels == '')
			$arr_labels = array();
		else
			$arr_labels = explode('_', $labels);
		$this->load->model('product_model');
		$res = $this->product_model->search($like, $arr_labels);
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