<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User controller
 * A class test the model and other functions
 * Created on 2014/9/26
 * @author fanz <251327341@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class Test extends CI_Controller {

	protected $db_fields;

	function __construct() {
		parent::__construct();
		// $this->load->library('session');
		$this->load->model('user_model','user');
		$this->load->helper('form');
		// $this->db_fields = $this->user->get_fields();
	}


	public function get_circle_list()
	{
		$this->load->model('circle_model', 'circle');
		$res = $this->circle->get_circle_list();

		header($this->config->item("header_json_utf8")); 	
		echo json_encode($res);
	}

	public function login()
	{
		

		$data['form_login'] = form_open('user/login');
		$data['form_register'] = form_open('user/register');
		$arr1 = array(
              'name'        => 'username',
              'id'          => 'username',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$arr2 = array(
              'name'        => 'password',
              'id'          => 'password',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$data['form_input'] = form_input($arr1);
		$data['form_psd'] = form_password($arr2);
		$data['form_submit'] = form_submit('submit','submit');
		$this->load->view('test/login',$data);
	}

	public function getsession($sessionid)
	{
		session_id($sessionid);
		session_start();
		echo $sessionid.'|'.strlen($sessionid).'|';
		if(isset($_SESSION['username']))
			echo $_SESSION['username'];
		else
			echo 'sessionid not existed! please login!';
		// unset($_SESSION['$sessionid']);
	}

	public function logoff($sessionid)
	{
		session_id($sessionid);
		session_start();
		session_destroy();
	}

	public function register()
	{
		
		$data['form_register'] = form_open('user/register');
		$arr1 = array(
              'name'        => 'username',
              'id'          => 'username',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$arr2 = array(
              'name'        => 'password',
              'id'          => 'password',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$data['form_input'] = form_input($arr1);
		$data['form_psd'] = form_password($arr2);
		$data['form_submit'] = form_submit('submit','submit');
		$this->load->view('test/register',$data);
	}

	public function user_info()
	{
		$data['form_info'] = form_open('user/get_user_info');
		$arr1 = array(
              'name'        => 'id',
              'id'          => 'id',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$arr2 = array(
              'name'        => 'sessionid',
              'id'          => 'sessionid',
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:50%',
            );
		$data['form_input'] = form_input($arr1);
		$data['form_session'] = form_input($arr2);
		$data['form_submit'] = form_submit('submit','submit');
		$this->load->view('test/userinfo',$data);
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