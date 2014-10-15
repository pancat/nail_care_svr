<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Circle controller
 * A class provided some methods about get circles list...
 * Created on 2014/10/10
 * @author fanz <2513273451@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class Circle extends CI_Controller {

	// protected $db_fields;



	function __construct() {
		parent::__construct();
		$this->load->model('circle_model');
		$this->load->helper('date');
		// $this->db_fields = $this->circle_model->get_fields();
	}


	public function index()
	{
		echo anchor(site_url('circle/get_circle_list')).'<br>';
		echo anchor(site_url('circle/get_circle_info/1')).'<br>';
		echo anchor(site_url('circle/get_circle_comments/1')).'<br>';
		echo anchor(site_url('circle/get_circle_images/1')).'<br>';
	}


	/**
	 * Get circles list information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	offset
	 * @param GET 	int 	limit
	 * @param GET 	string 	order
	 * @param GET 	boolean	desc
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	public function get_circle_list($offset = 0, $limit = 10, $order_by = "", $order = "desc")
	{
		$this->load->model('circle_model', 'circle');
		$res = $this->circle->get_circle_list($offset, $limit, $order_by, $order);

		header($this->config->item("header_json_utf8")); 	
		echo json_encode($res);
	}


	/**
	 * Get a circle information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	circle id
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	public function get_circle_info($circle_id = 0)
	{
		$this->load->model('circle_model', 'circle');
		$res = $this->circle->get_circle_info($circle_id);

		header($this->config->item("header_json_utf8")); 	
		echo json_encode($res);
	}

	/**
	 * Get a circle information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	circle id
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_circle_images($circle_id = 0)
	{
		$res = $this->circle_model->get_circle_images($circle_id);
		header($this->config->item("header_json_utf8")); 
		echo json_encode($res);
	}

	/**
	 * Get a circle comments information
	 * @author fanz <2513273451@qq.com>
	 * @param GET 	int 	circle_id 
	 * @param GET 	int 	offset
	 * @param GET 	int 	limit
	 * @param GET 	string 	order
	 * @param GET 	boolean	desc
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	public function get_circle_comments($circle_id = 0, $offset = 0, $limit = 10, $order_by = "", $order = "desc")
	{
		$this->load->model('circle_comment_model', 'comment');
		$res = $this->comment->get_circle_comments($circle_id, $offset, $limit, $order_by, $order);

		header($this->config->item("header_json_utf8")); 	
		echo json_encode($res);
	}




}



/* End of file circle.php */
/* Location: ./application/controllers/circle.php */