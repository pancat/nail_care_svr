<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User controller
 * A class provided some methods about user login, user register...
 * Created on 2014/9/25
 * @author fanz <251327341@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class User extends CI_Controller {

	/**
	 * 外部接口字段名($value是外部接口的字段名称)
	 */
	// const USER_ID 			= 'id';
	// const USER_NAME 		= 'username';
	// const PSD 				= 'password';
	// const NICK_NAME 		= 'nick_name';
	// const AGE 				= 'age';
	// const EMAIL 			= 'email';
	// const ADDR 				= 'address';
	// const AVATAR_URI 		= 'avatar_uri';
	// const REG_DATE 			= 'register_date';
	// const LAST_LOGIN 		= 'last_login';
	// const LAST_IP 			= 'last_ip';
	// const STATUS 			= 'status';
	// const LEVEL 			= 'level';
	// const REMARK 			= 'remark';
	


	// const RES_CODE 			= 'code';
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
		$this->load->library('IUser');
		$this->load->library('ICircle');
		$this->config->load('project');
		//session_start();
	}

	function index()
	{
		$this->load->view('welcome_message');
	}

	/**
	 * Login
	 * @author fanz <251327341@qq.com>
	 * @param POST string username, string password
	 * @return NULL 
	 * @access public
	 * @todo delete test code
	 */
	public function login() {	
		
		$res = array(
				IUser::RES_CODE 		=> '0',
				self::SESSION_ID	=>	''
				);
		// form validation
		$this->_init_login_validate();
		if($this->form_validation->run() == FALSE) {
			$res[IUser::RES_CODE] = '101';
		} 
		else {
			$arr = array(
				user_model::USER_NAME 	=> 		$this->input->post(IUser::USER_NAME,'0'),
				user_model::PSD 		=>		$this->input->post(IUser::PSD,'0'),
			);
			$data = $this->user_model->get_user_by_np($arr);
			if($data != FALSE) {
				// set session
				$data = $this->_gen_user_info($data);
				$log_time = now();
				$logtime = date('Y-m-d H:i:s',$log_time);
	 			$lastip = $this->input->ip_address();

	 			
				$sessionid = '';
	 			$is_login = $this->_doAuthUser(& $sessionid, $data[IUser::ID]);
	 			
	 			$session_data = array(
	 					self::SESSION_ID => $sessionid,
	 					self::SESSION_UID => $data[IUser::ID],
	 					self::SESSION_DATE => $logtime,
						);

	 			$this->load->model('session_model');
	 			if(!$is_login) {
	 				$this->session_model->insert_userdata($session_data);
	 			}
	 			else
	 				$this->session_model->update_userdata($session_data);

				$_SESSION['$sessionid'] = $sessionid;
	 			
	 			// $_SESSION['is_login'] = True;
				$res[IUser::RES_CODE] = '1';
				// set token
				$res['sessionid'] = $sessionid;
				$res = array_merge($res,$data);
			}
			else {
				$res[IUser::RES_CODE] = '102';
			}
		}

		header($this->config->item("header_json_utf8")); 
		echo json_encode($res);

		//for test
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}

	/**
	 * Logoff
	 * @author fanz <251327341@qq.com>
	 * @param POST int user_id, string session
	 * @return NULL 
	 * @access public
	 * @todo 判断数据库删除结果
	 */
	public function logoff($user_id = '', $sessionid = '') {
		$data = array( IUser::RES_CODE => '0' );
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
 			$data[IUser::RES_CODE] = '1';
	 		
		} else {
			$data[IUser::RES_CODE] = '101';
		}
		echo json_encode($data);
	}
	
	/**
	 * Register
	 * @author fanz <251327341@qq.com>
	 * @param POST string username, string password
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function register() {
		$res = array(	IUser::RES_CODE => '0'	);
		// form validation
		$this->_init_login_validate();
		if($this->form_validation->run() == FALSE) {
			$res[IUser::RES_CODE] = '101';
		} 
		else {
			$log_time = now();
			$arr = array(
				 user_model::USER_NAME 			=> 	$this->input->post(IUser::USER_NAME,'0'),
				 user_model::PSD 				=>	$this->input->post(IUser::PSD,'0'),
				 user_model::AVATAR_URI 		=>	base_url().'assets/res/images/avatar.jpg',
				 user_model::REG_DATE 			=> 	$log_time
			);
			// validate username 
			if($this->user_model->get_user_by_uname(array_slice($arr, 0, 1)) != FALSE) {
				$res[IUser::RES_CODE] = '102';
			} 
			else {
				$insert_res = $this->user_model->insert_entry($arr);
				// validate insert result
				if($insert_res == TRUE)
				{
					$user = $this->user_model->get_user_by_uname(array_slice($arr, 0, 1));
					if($user == true) {
						$res = array_merge($res, $this->_gen_user_info($user));
						$res[IUser::RES_CODE] = '1';
					}
					else {
						$res[IUser::RES_CODE] = '103';
					}

				}
			}
		}
		header($this->config->item("header_json_utf8")); 
		echo json_encode($res);
	}


	/**
	 * Get user information
	 * @author fanz <251327341@qq.com>
	 * @param POST string sessionid, int uuser_id
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function get_user_info() {
		$res = array( IUser::RES_CODE => '0' );
		$sessionid = $this->input->post( self::SESSION_ID, 0);
		$uid = $this->input->post( IUser::ID, 0);
		if($this->_doAuthUser($sessionid, $uid) != TRUE) {
			$res[IUser::RES_CODE] = '101';
		}
		else if($uid == 0) {
			$res[IUser::RES_CODE] = '102';
		} 
		else {
			$arr = array(
					user_model::ID 	=> 	$this->input->post(IUser::ID, 0)
					);
			$data = $this->user_model->get_user_by_id($arr);
			if($data != FALSE) {
				$data = $this->_gen_user_info($data);
				$res[IUser::RES_CODE] = '1';
				$res = array_merge($res, $data);
			} else {
				$res[IUser::RES_CODE] = '103';
			}
		}
		header($this->config->item("header_json_utf8")); 
		echo json_encode($res);
		// test
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}


	function add_circle() {

		$res = array( IUser::RES_CODE => '1');
		$id = $this->input->post('id');
		$session_id = $this->input->post('sessionid');
		$add_time = now();
		$field_name = ICircle::UPLOAD_FIELD_NAME;
		$arr_name = explode(".", $_FILES[$field_name]['name']);
		$upload_time = now();

		$config['upload_path'] = ICircle::UPLOAD_PATH;
		$config['allowed_types'] = 'gif|jpg|png';
  		$config['max_size'] = '10000';
  		$config['max_width']  = '2048';
  		$config['max_height']  = '2048';
		$config['file_name'] = date('YmdHis',$add_time).$id.rand(10,99).'.'.end($arr_name);
		$this->load->library('upload', $config);
  		if( !$this->upload->do_upload($field_name))
  		{
  			$res[IUser::RES_CODE] = '101';
  			log_message('error', $this->upload->display_errors());
  		}
  		else {
			$this->load->model('circle_model');
			$entry = array(
						circle_model::TITLE 	=> $this->input->post('title'),
						circle_model::CONTENT 	=> $this->input->post('content'),
						circle_model::IMAGE 	=> base_url().trim($config['upload_path'],'./').$config['file_name'],
						circle_model::CRE_DATE 	=> date('Y-m-d H:i:s', $add_time),
						circle_model::UID 		=> $id
					);

			$cid = $this->circle_model->insert_entry($entry);

			if($cid == FALSE)
			{
				$res[IUser::RES_CODE]  = '101';
			}
			else {
				$image_entry = array(
									circle_image_model::URI => base_url().trim($config['upload_path'],'./').$config['file_name'],
			  						circle_image_model::CID => $cid,
			  						circle_image_model::ORDER => 1,
								);
				$this->load->model('circle_image_model');
				$this->circle_image_model->insert_entry($image_entry);
				$res['cid'] = $cid;

			}
  		}
  		echo json_encode($res);
	}


	// function add_circle_image() {

	// 	// $this->load->helper('path');
	// 	$res = array( IUser::RES_CODE => '1');

	// 	$id = $this->input->post('id');
	// 	$cid = $this->input->post('cid');
	// 	$session_id = $this->input->post('sessionid');
	// 	$field_name = ICircle::UPLOAD_FIELD_NAME;
	// 	$upload_time = now();
	// 	$arr_name = explode(".", $_FILES[$field_name]['name']);

	// 	$config['upload_path'] = ICircle::UPLOAD_PATH;
	// 	$config['allowed_types'] = 'gif|jpg|png';
 //  		$config['max_size'] = '100';
 //  		$config['max_width']  = '1024';
 //  		$config['max_height']  = '768';

 //  		$config['file_name'] = date('YmdHis',now()).$id.rand(10,99).'.'.end($arr_name);
	// 	$this->load->library('upload', $config);
 //  		if( !$this->upload->do_upload($field_name))
 //  		{
 //  			$res[IUser::RES_CODE] = '101';
 //  			log_message('error', $this->upload->display_errors());
 //  		}
 //  		else {
 //  			$this->load->model('circle_image_model');
 //  			$entry = array(
 //  						circle_image_model::URI => base_url().trim($config['upload_path'],'./').$config['file_name'],
 //  						circle_image_model::CID => $cid,
 //  						circle_image_model::UID => $id,
 //  						circle_image_model::CID => $cid,
 //  					);
 //  			$this->circle_image_model->insert_entry($entry);
 //  		}
 //  		print_r($this->upload->data());
 //  		echo $res;
	// }

	function del_circle_image($id = '') {
		$this->load->model('circle_image_model');
		$this->circle_image_model->delete_entry(array(circle_image_model::ID => $id));
	}


	/**
	 * 将从数据库中取得的一个用户的信息进行编码
	 * $data中的字段名称与数据库有关
	 * @author fanz <251327341@qq.com>
	 * @param array
	 * @return array 
	 * @access private
	 * @todo
	 */
	private function _gen_user_info($data) {
		$arr = array(
			IUser::ID						=> 	$data[user_model::ID],
			IUser::USER_NAME				=>	$data[user_model::USER_NAME],
			IUser::NICK_NAME				=>	$data[user_model::NICK_NAME],
			// $this->interface_fields['psd'] 				=>	$data[$this->db_fields['psd']],
			IUser::AGE						=>	$data[user_model::AGE],
			IUser::STATUS					=>	$data[user_model::STATUS],
			IUser::EMAIL					=>	$data[user_model::EMAIL],
			IUser::LEVEL					=>	$data[user_model::LEVEL],
			IUser::AVATAR_URI				=>	$data[user_model::AVATAR_URI],
			IUser::ADDR						=>	$data[user_model::ADDR]
		);

		return $arr;
	}

	/**
	 * 验证sessionid
	 * @author fanz <251327341@qq.com>
	 * @param string $sessionid $user_id
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
	 * 登录表单验证规则的初始化
	 * @author fanz <251327341@qq.com>
	 * @todo 修改用户名规则
	 */
	private function _init_login_validate() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules(IUser::USER_NAME, '用户名', 'trim|required|is_natural|min_length[1]|xss_clean');
		$this->form_validation->set_rules(IUser::PSD, '密码', 'trim|required');
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
 	function delete_comment($id ='', $uid = '')
 	{
 		// $token = $this->
 		// if($this->_doAuthUser())
 		
 	}


 		// /**
	//  * 将从数据库中取得的多个用户的信息进行编码
	//  * $data中的字段名称与数据库有关
	//  * @author fanz <251327341@qq.com>
	//  * @param array
	//  * @return array 
	//  * @access private
	//  * @todo
	//  */
	// private function _gen_users_info($datas)
	// {
	// 	$arrs = array();
	// 	foreach ($datas as $item) {
	// 		$temp = $this->_gen_user_info($item);
	// 		$arr1 = array($temp['userid'] => $temp);
	// 		$arrs = array_merge($arrs, $arr1);
	// 	}
	// 	return $arrs;
	// }



}

/* End of file user.php */
/* Location: ./application/controllers/user.php */