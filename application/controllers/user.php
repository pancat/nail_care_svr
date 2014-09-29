<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User controller
 * A class provided some methods about user login, user register...
 * Created on 2014/9/25
 * @author fanz <2513273451@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class User extends CI_Controller {

	/**
	 * 数据库字段名($value是数据库中字段的名称)
	 * array(
 	 *					'user_id'			=> 'id'	,			//int 主键 id
 	 *					'user_name'			=> 'user_name',		//string 登录用户名
 	 *					'psd'				=> 'password',		//string 登录密码
 	 *					'nick_name'			=> 'nick_name',		//string 昵称
 	 *					'age'				=> 'age',			//int 年龄
 	 *					'email'				=> 'email',			//string 邮箱
 	 *					'address'			=> 'address',		//string 地址
 	 *					'avatar_uri'		=> 'avatar_uri',	//string 头像uri
 	 *					'register_date'		=> 'register_date', //string 注册时间
 	 *					'last_login'		=> 'last_login', 	//string 最近登录时间
 	 *					'last_ip'			=> 'last_ip',		//string 最近登录ip
 	 *					'status'			=> 'status',		//int 状态：1（正常），0（冻结），-1（删除）
 	 *					'level'				=> 'level',			//int 等级：1（普通用户）...
 	 *					'remark'			=> 'remark'			//string 备注
 	 *					);
	 */
	protected $db_fields;

	/**
	 * 外部接口字段名($value是外部接口的字段名称)
	 */
	protected $interface_fields = array(
 						'user_id'			=> 'id'	,			//int 主键 id
 						'user_name'			=> 'username',		//string 登录用户名
 						'psd'				=> 'password',		//string 登录密码
 						'nick_name'			=> 'nick_name',		//string 昵称
 						'age'				=> 'age',			//int 年龄
 						'email'				=> 'email',			//string 邮箱
 						'address'			=> 'address',		//string 地址
 						'avatar_uri'		=> 'avatar_uri',	//string 头像uri
 						'register_date'		=> 'register_date', //string 注册时间
 						'last_login'		=> 'last_login', 	//string 最近登录时间
 						'last_ip'			=> 'last_ip',		//string 最近登录ip
 						'status'			=> 'status',		//int 状态：1（正常），0（冻结），-1（删除）
 						'level'				=> 'level',			//int 等级：1（普通用户）...
 						'remark'			=> 'remark',		//string 备注
 						'res_state'			=> 'res_state',		//int 操作结果：0 (失败) 1(成功)
 						'error_code'		=> 'error_code'		//string 错误代码，具体查看接口文档
 						);
	/**
	 * session的字段名
	 */
	protected $session_fields = array(
								'user_id'	=>	'id',
								'user_name' =>	'name',
								'level'		=>	'level',
								'logged_in' =>	'is_logged',
								'log_time' =>	'log_time'
							);

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->helper('date');
		$this->db_fields = $this->user_model->get_fields();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	/**
	 * Login
	 * @author fanz <2513273451@qq.com>
	 * @param POST string username, string password
	 * @return NULL 
	 * @access public
	 * @todo delete test code
	 */
	public function login()
	{	
		$res = array(
				$this->interface_fields['res_state'] => 0,
				$this->interface_fields['error_code'] => '000',
				'token'	=>''
				);

		// form validation
		$this->_init_login_validate();
		if($this->form_validation->run() == FALSE) {
			$res[$this->interface_fields['error_code']] = '101';
		} 
		else {
			$arr = array(
				$this->db_fields['user_name'] => 
								$this->input->post($this->interface_fields['user_name'],'0'),
				$this->db_fields['psd'] =>
								$this->input->post($this->interface_fields['psd'],'0'),
			);
			$data = $this->user_model->get_user_by_np($arr);
			
			if($data != FALSE) {
				// set session
				$data = $this->_gen_user_info($data);
				$log_time = now();
				$logtime = date('Y-m-d H:i:s',$log_time);
	 			$lastip = $this->input->ip_address();
	 			$session_data = array(
	 					$this->session_fields['user_id'] => $data[$this->interface_fields['user_id']],
	 					$this->session_fields['user_name'] => $data[$this->interface_fields['user_name']],
	 					$this->session_fields['logged_in'] => TRUE,
	 					$this->session_fields['log_time'] => $log_time,
	 					$this->session_fields['level'] => $data[$this->interface_fields['level']]
						);
	 			$this->session->set_userdata($session_data);

				$res[$this->interface_fields['res_state']] = 1;
				$res[$this->interface_fields['error_code']] = '100';
				// set token
				$res['token'] = md5($data[$this->interface_fields['user_name']].
									$data[$this->interface_fields['level']].$log_time)
								.rand(10, 99);
				$res = array_merge($res,$data);
			}
			else {
				$res[$this->interface_fields['error_code']] = '102';
			}
		}
		echo json_encode($res);
		//for test
		echo "\n".$res['avatar_uri'];
		echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
		echo '<p> logged_in: '.$this->session->userdata($this->session_fields['logged_in']);
	}

	/**
	 * 登录表单验证规则的初始化
	 * @author fanz <2513273451@qq.com>
	 * @todo 修改用户名规则
	 */
	private function _init_login_validate() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->interface_fields['user_name'], '用户名', 'trim|required|is_natural|min_length[1]|xss_clean');
		$this->form_validation->set_rules($this->interface_fields['psd'], '密码', 'trim|required');
	}

	/**
	 * Register
	 * @author fanz <2513273451@qq.com>
	 * @param POST string username, string password
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function register() {
		$res = array(
				$this->interface_fields['res_state'] => 0,
				$this->interface_fields['error_code'] => '000'
				);
		// form validation
		$this->_init_login_validate();
		if($this->form_validation->run() == FALSE) {
			$res[$this->interface_fields['error_code']] = '101';
		} 
		else {
			$arr = array(
				$this->db_fields['user_name'] => 
								$this->input->post($this->interface_fields['user_name'],'0'),
				$this->db_fields['psd'] =>
								$this->input->post($this->interface_fields['psd'],'0'),
				$this->db_fields['avatar_uri'] =>
								base_url().'assets/res/images/avatar.jpg',
				$this->db_fields['register_date'] => now()
			);
			// validate username 
			if($this->user_model->get_user_by_uname(array_slice($arr, 0, 1)) != FALSE) {
				$res[$this->interface_fields['error_code']] = '102';
			} 
			else {
				$insert_res = $this->user_model->insert_entry($arr);
				// validate insert result
				if($insert_res == TRUE)
				{
					$user = $this->user_model->get_user_by_uname(array_slice($arr, 0, 1));
					if($user == true) {
						$res = array_merge($res, $this->_gen_user_info($user));
						$res[$this->interface_fields['res_state']] = 1;
						$res[$this->interface_fields['error_code']] = '100';
					}
					else {
						$res[$this->interface_fields['error_code']] = '103';
					}

				}
				
			}
		}
		echo json_encode($res);
	}


	/**
	 * Get user information
	 * @author fanz <2513273451@qq.com>
	 * @param POST int id
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_user_info()
	{
		$res = array(
				$this->interface_fields['res_state'] => 0,
				$this->interface_fields['error_code'] => '000'
				);
		$token = $this->input->post('token', 0);
		$uid = $this->input->post($this->interface_fields['user_id'], 0);
		if($this->_token_validation($token) != TRUE) {
			$res[$this->interface_fields['error_code']] = '101';
		}
		else if($uid == 0) {
			$res[$this->interface_fields['error_code']] = '102';
		} 
		else {
			$arr = array(
					$this->db_fields['user_id'] => 
									$this->input->post($this->interface_fields['user_id'], 0)
					);
			$data = $this->user_model->get_user_by_id($arr);
			if($data != FALSE) {
				$data = $this->_gen_user_info($data);
				$res[$this->interface_fields['res_state']] = 1;
				$res[$this->interface_fields['error_code']] = '100';
				$res = array_merge($res, $data);
			} else {
				$res[$this->interface_fields['error_code']] = '103';
			}
		}
		echo json_encode($res);
		echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}

	/**
	 * 将从数据库中取得的一个用户的信息进行编码
	 * $data中的字段名称与数据库有关
	 * @author fanz <2513273451@qq.com>
	 * @param array
	 * @return array 
	 * @access private
	 * @todo
	 */
	private function _gen_user_info($data)
	{
		$arr = array(
			$this->interface_fields['user_id']			=> 	$data[$this->db_fields['user_id']],
			$this->interface_fields['user_name']		=>	$data[$this->db_fields['user_name']],
			$this->interface_fields['nick_name']		=>	$data[$this->db_fields['nick_name']],
			// $this->interface_fields['psd'] 				=>	$data[$this->db_fields['psd']],
			$this->interface_fields['age']				=>	$data[$this->db_fields['age']],
			$this->interface_fields['status']			=>	$data[$this->db_fields['status']],
			$this->interface_fields['email']			=>	$data[$this->db_fields['email']],
			$this->interface_fields['level']			=>	$data[$this->db_fields['level']],
			$this->interface_fields['avatar_uri']		=>	$data[$this->db_fields['avatar_uri']],
			$this->interface_fields['address']			=>	$data[$this->db_fields['address']]
		);

		return $arr;
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
	 * 将从数据库中取得的多个用户的信息进行编码
	 * $data中的字段名称与数据库有关
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

/* End of file user.php */
/* Location: ./application/controllers/user.php */