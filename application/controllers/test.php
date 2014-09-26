<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User controller
 * A class test the model and other functions
 * Created on 2014/9/26
 * @author fanz <2513273451@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class Test extends CI_Controller {

	protected $db_fields;

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model','user');
		$this->db_fields = $this->user->get_fields();
	}

	public function index()
	{
		$this->load->helper('form');

		$data['form'] = form_open('user/login');
		$arr1 = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => 'johndoe',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$arr2 = array(
              'name'        => 'password',
              'id'          => 'password',
              'value'       => 'johndoe',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$data['form_input'] = form_input($arr1);
		$data['form_psd'] = form_password($arr2);
		$data['form_submit'] = form_submit('submit','submit');
		$this->load->view('test',$data);
	}

	/**
	 * Test the function get_user in user_model.php
	 */
	public function get_user()
	{
		$username = 'root';
		$password = md5('123');

		//将数据存储到数据中
		$arr = array(
			'username'	=>	$username,
			'psd' 		=>	$password
		);

		$this->load->model('user_model','user');
		$data = $this->user->get_user($arr);
		echo $this->_gen_userinfo_json($data);
	}

	public function get_users()
	{
		$datas = $this->user->get_all_users();

		// $arr = array();
		// foreach($datas as $item)
		// {	
		// 	$temp = $this->_gen_userinfo_json($item);
		// 	$arr1 = array($temp['userid'] => $temp);
		// 	array_merge($arr, $arr1);
		// }
		$res = $this->_gen_users_info($datas);
		echo json_encode($res);
	}

	/**
	 * Test the function random_string in helper string
	 */
	public function test_helper_string()
	{
		$this->load->helper('string');
		echo random_string('alnum',16);
	}

	public function tests()
	{
		print_r($this->db_fields);
	}
	
	/**
	 * 将从数据库中取得的一个用户的信息编码为json格式
	 * $data中的字段名称与数据库有关
	 */
	private function _gen_user_info($data)
	{
		$arr = array(
			'userid'		=> 	$data->id,
			'username'		=>	$data->user_name,
			'password' 		=>	$data->password,
			'email'			=>	$data->email
		);

		return $arr;
	}

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

}

/* End of file test.php */
/* Location: ./application/controllers/test.php */