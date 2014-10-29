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
	 * session的字段名
	 */
	const SESSION_ID 		= 'sessionid';
	const SESSION_UID 		= 'uid';
	const SESSION_DATE 		= 'last_date'; 

	public $sessionid = '';

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
		// $this->load->view('welcome_message');
	}

	/**
	 * Login
	 * @author fanz <251327341@qq.com>
	 * @param POST string username, string password
	 * @return NULL 
	 * @access public
	 * @todo delete test code
	 */
	// public function login() {
	// 	echo 'loogin'.$this->sessionid;
	// }

	
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

	 			
				
	 			$is_login = $this->_doAuthUser('', $data[IUser::ID]);
	 			$session_data = array(
	 					self::SESSION_ID => $this->sessionid,
	 					self::SESSION_UID => $data[IUser::ID],
	 					self::SESSION_DATE => $logtime,
						);


				// $res[IUser::RES_CODE] = '12'.$is_login;
	 			$this->load->model('session_model');
	 			if(!$is_login) {
	 				$this->session_model->insert_userdata($session_data);
	 			}
	 			else
	 				$this->session_model->update_userdata($session_data);

				// $_SESSION['$sessionid'] = $this->sessionid;	//
				// $_SESSION['is_login'] = True;
				$res[IUser::RES_CODE] = '1';
				$res['sessionid'] = $this->sessionid;
				$res = array_merge($res,$data); 
			}
			else {
				//用户名与密码组合错误
				$res[IUser::RES_CODE] = '102';
			}
		}

		// header($this->config->item("header_json_utf8")); 
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
				 user_model::REGISTER_DATE 		=> 	$log_time
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
		//header($this->config->item("header_json_utf8")); 
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
		$sessionid = $this->input->post( self::SESSION_ID, '');
		$uid = $this->input->post( IUser::ID, 0);
		if($this->_doAuthUser($sessionid, $uid) != TRUE) {
			$res[IUser::RES_CODE] = '101';
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
				$res[IUser::RES_CODE] = '102';
			}
		} 
		echo json_encode($res);
		// test
		// echo '<div><img src="'.$res['avatar_uri'].'" /></div>';
	}


	/**
	 * Add a circle information include a image
	 * @author fanz <251327341@qq.com>
	 * @param string sessionid 
	 * @param int id 用户id
	 * @param string content 圈子内容
	 * @param file uploadfile 图片文件
	 * @return NULL 
	 * @access public
	 * @todo 
	 */
	function add_circle() {
		$res = array( IUser::RES_CODE => '1');
		$id = $this->input->post(IUser::ID);
		$session_id = $this->input->post(self::SESSION_ID);
		$add_time = now();
		$year_month = date('Ym',$add_time);
		$full_path = $_SERVER['DOCUMENT_ROOT'].$this->config->item('project_name').ICircle::UPLOAD_PATH.'/'.$year_month;
		$this->load->helper('dir_helper');
		if(!$this->_doAuthUser($session_id, $id))
		{
			$res[IUser::RES_CODE]  = '201';
		}
		else if (!new_dir($full_path)) {
			$res[IUser::RES_CODE]  = '202';			//无法创建文件夹		
		}
		else 
		{
			// 上传图片到服务器
			$field_name = ICircle::UPLOAD_FIELD_NAME;
			$arr_name = explode(".", $_FILES[$field_name]['name']);
			$config['upload_path'] = '.'.ICircle::UPLOAD_PATH.'/'.$year_month.'/';
			$config['allowed_types'] = 'gif|jpg|png';
	  		$config['max_size'] = '10000';
	  		$config['max_width']  = '2048';
	  		$config['max_height']  = '2048';
			$config['file_name'] = date('YmdHis',$add_time).$id.rand(10,99).'.'.end($arr_name);
			$this->load->library('upload', $config);
	  		if( !$this->upload->do_upload($field_name))
	  		{
	  			$res[IUser::RES_CODE] = '203';					// 上传图片文件失败
	  			log_message('error', $this->upload->display_errors());
	  		} else {
	  			// 写入数据库
	  			$image_info = $this->upload->data();
	  			$image_url = ltrim($config['upload_path'], '.').$config['file_name'];
				$this->load->model('circle_model');
				$entry = array(
							circle_model::TITLE 	=> $this->input->post('title'),
							circle_model::CONTENT 	=> $this->input->post('content', ''),
							circle_model::CRE_DATE 	=> date('Y-m-d H:i:s', $add_time),
							circle_model::UID 		=> $id,
							circle_model::IMAGE 	=> $image_url,
							circle_model::WIDTH 	=> $image_info['image_width'],
							circle_model::HEIGHT 	=> $image_info['image_height']
						);
				$cid = $this->circle_model->insert_entry($entry);
				if($cid == FALSE) {
					$res[IUser::RES_CODE]  = '204'; 			// 数据库写入失败
					@unlink($image_info['full_path']);       	// 删除服务器中的图片
				} else {
					$res[ICircle::ID]  = $cid;
					$this->load->model('circle_image_model');
					$image_entry = array(
								circle_image_model::URI => $image_url,
		  						circle_image_model::CID => $cid,
		  						circle_image_model::ORDER => 1,
		  						circle_image_model::WIDTH 	=> $image_info['image_width'],
								circle_image_model::HEIGHT 	=> $image_info['image_height']
							);
					if( $this->circle_image_model->insert_entry($image_entry) == FALSE)
						$res[IUser::RES_CODE]  = '205'; 			// 图片数据库写入失败
				}
	  			
	  		}

		}
  		echo json_encode($res);
	}

	function _circle_exist($uid, $cid) {
		$this->load->model('circle_model');
		$arr = array(
 				circle_model::ID => $cid,
 				circle_model::UID => $uid
 				);
		if($this->circle_model->circle_exist($arr))
			return TRUE;
		else
			return FALSE;
	}

	function add_circle_image() {
		$res = array( IUser::RES_CODE => '1');
		$uid = $this->input->post('uid');
		$cid = $this->input->post('cid');
		$session_id = $this->input->post(self::SESSION_ID);
		$add_time = now();
		$field_name = ICircle::UPLOAD_FIELD_NAME;
		$year_month = date('Ym',$add_time);
		$full_path = $_SERVER['DOCUMENT_ROOT'].$this->config->item('project_name').ICircle::UPLOAD_PATH.'/'.$year_month;
		$this->load->helper('dir_helper');
		if(!$this->_doAuthUser($session_id, $uid))
		{
			$res[IUser::RES_CODE]  = '201';
		}
		else if (!new_dir($full_path)) {
			$res[IUser::RES_CODE]  = '202';			//无法创建文件夹		
		}
		else if (!$this->_circle_exist($uid, $cid)) {
			$res[IUser::RES_CODE]  = '203';
		}
		else 
		{
			// 上传图片到服务器
			$field_name = ICircle::UPLOAD_FIELD_NAME;
			$arr_name = explode(".", $_FILES[$field_name]['name']);
			$config['upload_path'] = '.'.ICircle::UPLOAD_PATH.'/'.$year_month.'/';
			$config['allowed_types'] = 'gif|jpg|png';
	  		$config['max_size'] = '10000';
	  		$config['max_width']  = '2048';
	  		$config['max_height']  = '2048';
			$config['file_name'] = date('YmdHis',$add_time).$uid.rand(10,99).'.'.end($arr_name);
			$this->load->library('upload', $config);
	  		if( !$this->upload->do_upload($field_name)) {
	  			$res[IUser::RES_CODE] = '204';						// 上传图片文件失败
	  			log_message('error', $this->upload->display_errors());
	  		} 
	  		else {
	  			// 写入数据库
	  			$image_info = $this->upload->data();
	  			$image_url = ltrim($config['upload_path'], '.').$config['file_name'];
				$this->load->model('circle_image_model');
				$image_entry = array(
									circle_image_model::URI 	=> $image_url,
			  						circle_image_model::CID 	=> $cid,
			  						circle_image_model::ORDER 	=> 2,
			  						circle_image_model::WIDTH 	=> $image_info['image_width'],
									circle_image_model::HEIGHT 	=> $image_info['image_height']
								);
				$re = $this->circle_image_model->insert_entry($image_entry);
				if(!$re)
					$res[IUser::RES_CODE] = "101";
	  		}
		}

		echo json_encode($res);
	}


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

		if($user_id == '') 
			return FALSE;
		if($sessionid == '') {
			session_start();
			$this->sessionid = session_id();
		}
		else {
			$this->sessionid = $sessionid;
			session_id($this->sessionid);
			session_start();
		}
		if(!isset($_SESSION[self::SESSION_UID]) || !$_SESSION[self::SESSION_UID] == $user_id)
			$_SESSION[self::SESSION_UID] = $user_id;

		$this->load->model('session_model');
		$res = $this->session_model->is_login( array(
								session_model::SESSION_ID => $this->sessionid,
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
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function delete_comment($id ='', $uid = '') {
 		// $token = $this->
 		// if($this->_doAuthUser())
 		
 	}

 	/**
 	 * Add a comment item 
 	 * Created on 2014/10/18
 	 * @param array $arr =
 	 *				int 		'uid'	  					用户id
 	 *				string 		'sessionid'  				sessionid
 	 *				int 		'circle_id'  				圈子id
 	 *				string 		'comments'  				评论内容
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function add_comment() {
 		$this->load->library('ICirComment');
 		$res = array( IUser::RES_CODE => '0');

 		$user_id = $this->input->post(ICirComment::UID, 0);
 		$session_id = $this->input->post(self::SESSION_ID);
 		if($this->_doAuthUser($session_id, $user_id))
 		{
 			$this->load->model('Circle_comment_model');
 			$this->load->library('ICirComment');
 			$time = date('Y-m-d H:i:s',now());
 			$entry = array(
 					Circle_comment_model::CID => $this->input->post(ICirComment::CID, 0),
 					Circle_comment_model::UID => $user_id,
 					Circle_comment_model::COMMENTS => $this->input->post(ICirComment::COMMENTS, ''),
 					Circle_comment_model::CRE_DATE => $time
 				);

 			if($entry[Circle_comment_model::UID] == 0 || $entry[Circle_comment_model::CID] == 0 || $entry[Circle_comment_model::COMMENTS] == '')
 			{
 				$res[IUser::RES_CODE] = '102';
 			} else {
 				if(($id = $this->Circle_comment_model->insert_entry($entry)) != FALSE)
 				{
 					$res[IUser::RES_CODE] = '1';
					$res[ICirComment::ID] = $id;
					$res[ICirComment::UID] = $entry[Circle_comment_model::UID];
					$res[ICirComment::CID] = $entry[Circle_comment_model::CID];
					$res[ICirComment::COMMENTS] = $entry[Circle_comment_model::COMMENTS];
					$res[ICirComment::CRE_DATE] = $entry[Circle_comment_model::CRE_DATE];
 				}
 				else {
 					$res[IUser::RES_CODE] = '103';
 				}
 			}

 		} else {
 			$res[IUser::RES_CODE] = '101';
 		}
 		echo json_encode($res);
 		
 	}


	/**
 	 * Upload a user's avatar image 
 	 * Created on 2014/10/28
 	 * @param array $arr =
 	 *				int 		'id'	  					用户id
 	 *				string 		'sessionid'  				sessionid
 	 *				file 		'uploadavatar'  			头像图片
 	 * @return  array
 	 * 			
 	 */
 	function upload_avatar() {
 		$res = array( IUser::RES_CODE => '1');
		$id = $this->input->post(IUser::ID);
		$session_id = $this->input->post(self::SESSION_ID);
		$field_name = IUser::UPLOAD_AVATAR_FIELD;
		$add_time = now();
		$year_month = date('Ym',$add_time);
		$full_path = $_SERVER['DOCUMENT_ROOT'].$this->config->item('project_name').IUser::UPLOAD_AVATAR_PATH.'/'.$year_month;
		$this->load->helper('dir_helper');
		if(!$this->_doAuthUser($session_id, $id)) {
			$res[IUser::RES_CODE]  = '201';
		}
		else if (!new_dir($full_path)) {
			$res[IUser::RES_CODE]  = '207';			//无法创建文件夹		
		}
		else 
		{
			
			// 上传图片
			$arr_name = explode(".", $_FILES[$field_name]['name']);
			// var_dump($arr_name);
			$config['upload_path'] = '.'.IUser::UPLOAD_AVATAR_PATH.'/'.$year_month.'/';
			$config['allowed_types'] = 'gif|jpg|png';
	  		$config['max_size'] = '10000';
	  		$config['max_width']  = '2048';
	  		$config['max_height']  = '2048';
			$config['file_name'] = date('YmdHis',$add_time).$id.rand(10,99).'.'.end($arr_name);

			$this->load->library('upload', $config);
	  		if($this->upload->do_upload($field_name))
	  		{
	  			// 保存图片信息到数据库
				$image_info = $this->upload->data();
				// echo $image_info['image_width'].' '.$image_info['image_height'].' ';
				// echo json_encode($image_info);
				$image_url = ltrim($config['upload_path'], '.').$config['file_name'];
				$arr = array(
						user_model::AVATAR_URI => $image_url,
						user_model::AVATAR_WIDTH => $image_info['image_width'],
						user_model::AVATAR_HEIGHT => $image_info['image_height'],
						);
				$old_data = $this->user_model->get_avatar_url($id);
				$old_avatar_uri = $old_data[IUser::AVATAR_URI];
				$re = $this->user_model->update_avatar_info($id, $arr);
				if($re) {
					$res[IUser::AVATAR_URI]  = $image_url;
					@unlink($_SERVER['DOCUMENT_ROOT'].$this->config->item('project_name').'/'.$old_avatar_uri);
				}
				else {
					$res[IUser::RES_CODE]  = '203'; 		// 图片保存数据库失败
					@unlink($image_info['full_path']);       // 删除服务器中的图片
				}
	  		} else {
	  			$res[IUser::RES_CODE]  = '202';				// 图片上传数据库失败
	  		}
		}

		echo json_encode($res);
 	}



 	function update_nickname() {
 		$res = array( IUser::RES_CODE => '1');
 		$id = $this->input->post('id');
		$session_id = $this->input->post(self::SESSION_ID);
		$nickname = $this->input->post('nickname');

		if(!$this->_doAuthUser($session_id, $id)) { 
			$res[IUser::RES_CODE]  = '201';
		} else {
			$arr = array(
					user_model::ID => $id,
					user_model::NICK_NAME => $nickname
					);
			$re = $this->user_model->update_entry($id, $arr);
			if(!$re)
				$res[IUser::RES_CODE]  = '202';
		}
		echo json_encode($res);
 	}

 	function update_password() {
 		$res = array( IUser::RES_CODE => '1');
 		$id = $this->input->post('id');
		$session_id = $this->input->post(self::SESSION_ID);
		$psd = $this->input->post('password');

		if(!$this->_doAuthUser($session_id, $id)) { 
			$res[IUser::RES_CODE]  = '201';
		} else {
			$arr = array(
					user_model::ID => $id,
					user_model::PSD => $psd
					);
			$re = $this->user_model->update_entry($id, $arr);
			if(!$re)
				$res[IUser::RES_CODE]  = '202';
		}
		echo json_encode($res);
 	}



}

/* End of file user.php */
/* Location: ./application/controllers/user.php */