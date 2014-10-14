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
	const USER_ID 			= 'id';
	const USER_NAME 		= 'username';
	const PSD 				= 'password';
	const NICK_NAME 		= 'nick_name';
	const AGE 				= 'age';
	const EMAIL 			= 'email';
	const ADDR 				= 'address';
	const AVATAR_URI 		= 'avatar_uri';
	const REG_DATE 			= 'register_date';
	const LAST_LOGIN 		= 'last_login';
	const LAST_IP 			= 'last_ip';
	const STATUS 			= 'status';
	const LEVEL 			= 'level';
	const REMARK 			= 'remark';
	
	const RES_CODE 			= 'code';

	/**
	 * session的字段名
	 */
	const SESSION_ID 		= 'sessionid';
	const SESSION_UID 		= 'uid';
	const SESSION_DATE 		= 'last_date'; 


	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('date');
		$this->db_fields = $this->user_model->get_fields();
		//session_start();
	}

	function index()
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
				self::RES_CODE 		=> '0',
				self::SESSION_ID	=>	''
				);
		// form validation
		$this->_init_login_validate();
		if($this->form_validation->run() == FALSE) {
			$res[self::RES_CODE] = '101';
		} 
		else {
			$arr = array(
				$this->db_fields['user_name'] => 
								$this->input->post(self::USER_NAME,'0'),
				$this->db_fields['psd'] =>
								$this->input->post(self::PSD,'0'),
			);
			$data = $this->user_model->get_user_by_np($arr);
			if($data != FALSE) {
				// set session
				$data = $this->_gen_user_info($data);
				$log_time = now();
				$logtime = date('Y-m-d H:i:s',$log_time);
	 			$lastip = $this->input->ip_address();

	 			
				$sessionid = '';
	 			$is_login = $this->_doAuthUser(& $sessionid, $data[self::USER_ID]);
	 			
	 			$session_data = array(
	 					self::SESSION_ID => $sessionid,
	 					self::SESSION_UID => $data[self::USER_ID],
	 					self::SESSION_DATE => $logtime,
						);

	 			$this->load->model('session_model');
	 			if(!$is_login) {
	 				$this->session_model->insert_userdata($session_data);
	 			}
	 			else
	 				$this->session_model->update_userdata($session_data);

				$_SESSION['$sessionid'] = $sessionid;
	 			// 
	 			// $_SESSION['is_login'] = True;
				$res[self::RES_CODE] = '1';
				// set token
				$res['sessionid'] = $sessionid;
				$res = array_merge($res,$data);
			}
			else {
				$res[self::RES_CODE] = '102';
			}
		}

		header($this->config->item("header_json_utf8")); 
		echo json_encode($res);

		//for test
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}

	/**
	 * Logoff
	 * @author fanz <2513273451@qq.com>
	 * @param POST int user_id, string session
	 * @return NULL 
	 * @access public
	 * @todo 判断数据库删除结果
	 */
	public function logoff($user_id = '', $sessionid = '')
	{
		$data = array( self::RES_CODE => '0' );
		// echo json_encode($res); 
		if($sessionid != '' && $user_id != '') {
			session_id($sessionid);
			session_start();
			session_destroy();
			$this->load->model('session_model');
	 		$res = $this->session_model->del_item(array(
	 									session_model::	SESSION_ID 	=> $sessionid,
	 									session_model::	USER_ID 	=> $user_id
	 								));
 			$data[self::RES_CODE] = '1';
	 		
		} else {
			$data[self::RES_CODE] = '101';
		}
		echo json_encode($data);
	}


	/**
	 * 登录表单验证规则的初始化
	 * @author fanz <2513273451@qq.com>
	 * @todo 修改用户名规则
	 */
	private function _init_login_validate() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules(self::USER_NAME, '用户名', 'trim|required|is_natural|min_length[1]|xss_clean');
		$this->form_validation->set_rules(self::PSD, '密码', 'trim|required');
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
				self::RES_CODE => '0'
				);
		// form validation
		$this->_init_login_validate();
		if($this->form_validation->run() == FALSE) {
			$res[$this->interface_fields['error_code']] = '101';
		} 
		else {
			$log_time = now();
			$arr = array(
				$this->db_fields['user_name'] => 
								$this->input->post(self::USER_NAME,'0'),
				$this->db_fields['psd'] =>
								$this->input->post(self::PSD,'0'),
				$this->db_fields['avatar_uri'] =>
								base_url().'assets/res/images/avatar.jpg',
				$this->db_fields['register_date'] => $log_time
			);
			// validate username 
			if($this->user_model->get_user_by_uname(array_slice($arr, 0, 1)) != FALSE) {
				$res[self::RES_CODE] = '102';
			} 
			else {
				$insert_res = $this->user_model->insert_entry($arr);
				// validate insert result
				if($insert_res == TRUE)
				{
					$user = $this->user_model->get_user_by_uname(array_slice($arr, 0, 1));
					if($user == true) {
						$res = array_merge($res, $this->_gen_user_info($user));
						$res[self::RES_CODE] = '1';
					}
					else {
						$res[self::RES_CODE] = '103';
					}

				}
			}
		}
		header($this->config->item("header_json_utf8")); 
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
	function get_user_info() {
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
		header($this->config->item("header_json_utf8")); 
		echo json_encode($res);
		// test
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
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
			self::USER_ID				=> 	$data[$this->db_fields['user_id']],
			self::USER_NAME				=>	$data[$this->db_fields['user_name']],
			self::NICK_NAME				=>	$data[$this->db_fields['nick_name']],
			// $this->interface_fields['psd'] 				=>	$data[$this->db_fields['psd']],
			self::AGE					=>	$data[$this->db_fields['age']],
			self::STATUS				=>	$data[$this->db_fields['status']],
			self::EMAIL					=>	$data[$this->db_fields['email']],
			self::LEVEL					=>	$data[$this->db_fields['level']],
			self::AVATAR_URI			=>	$data[$this->db_fields['avatar_uri']],
			self::ADDR					=>	$data[$this->db_fields['address']]
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
	 * 验证token
	 * @author fanz <2513273451@qq.com>
	 * @param string $token
	 * @return boolean 
	 * 				true 	token验证合法
	 *				false 	token验证不合法
	 * @todo
	 * @access private
	 */
	private function _doAuthUser($sessionid = '', $user_id = '') {
		session_start();
		$sessionid = session_id();
		if($user_id == '')
			return FALSE;
		// session_id($sessionid);
		// session_start();
		if(!isset($_SESSION[self::SESSION_UID]) || !$_SESSION[self::SESSION_UID] == $user_id)
			$_SESSION[self::SESSION_UID] = $user_id;

		$this->load->model('session_model');
		$res = $this->session_model->is_login( array(
								session_model::SESSION_ID => $sessionid,
								session_model::USER_ID    => $user_id
							));
		return $res;
	}


	/**
 	 * Delete a comment item 
 	 * Created on 2014/10/14
 	 * @param array $arr =
 	 *				int 		'user_id'  					用户id
 	 *				int 		'comment_uid'  				评论id
 	 *				int 		'comment_uid'  				评论id
 	 *				int 		'comment_uid'  				评论id
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function delete_entry($comment_id)
 	{
 		// $token = $this->
 		// if($this->_doAuthUser())
 		
 	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */