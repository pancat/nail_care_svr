<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Business controller
 * A class provided some methods about business login, business register...
 * Created on 2014/9/25
 * @author fanz <251327341@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class Business extends CI_Controller {
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
		$this->load->library('IProduct');
		$this->config->load('project');
		//session_start();
	}

	function index()
	{
		// $this->load->view('welcome_message');
	}


	function add_product() {
		$res = array( IUser::RES_CODE => '1');
		$uid = $this->input->post('uid');
		$utype = $this->input->post('utype');
		$session_id = $this->input->post(self::SESSION_ID);
		$add_time = now();
		$field_name = IProduct::UPLOAD_FIELD_NAME;
		$year_month = date('Ym',$add_time);
		$full_path = $_SERVER['DOCUMENT_ROOT'].$this->config->item('project_name').IProduct::UPLOAD_PATH.'/'.$year_month;
		$this->load->helper('dir_helper');
		if(!$this->_doAuthBusi($session_id, $uid, $utype))
		{
			$res[IUser::RES_CODE]  = '201';
		}
		else if (!new_dir($full_path)) {
			$res[IUser::RES_CODE]  = '202';			//无法创建文件夹		
		}
		else 
		{
			// 上传图片到服务器
			$field_name = IProduct::UPLOAD_FIELD_NAME;
			$arr_name = explode(".", $_FILES[$field_name]['name']);
			$config['upload_path'] = '.'.IProduct::UPLOAD_PATH.'/'.$year_month.'/';
			$config['allowed_types'] = 'gif|jpg|png';
	  		$config['max_size'] = '10000';
	  		$config['max_width']  = '2048';
	  		$config['max_height']  = '2048';
			$config['file_name'] = date('YmdHis',$add_time).$uid.rand(10,99).'.'.end($arr_name);
			$this->load->library('upload', $config);
			// var_dump($field_name);
	  		if( !$this->upload->do_upload($field_name)) {
	  			$res[IUser::RES_CODE] = '204';						// 上传图片文件失败
	  			log_message('error', $this->upload->display_errors());
	  		} 
	  		else {
	  			// $res['full_path']  = $config['full_path'];	
	  			// 写入数据库
	  			$image_info = $this->upload->data();
	  			$image_url = ltrim($config['upload_path'], '.').$config['file_name'];
				$this->load->model('product_model');
				$entry = array(
									product_model::THUMB_IMAGE => $image_url,
			  						product_model::MID 		=> $uid,
			  						product_model::TYPE 	=> $utype,
			  						product_model::WIDTH 	=> $image_info['image_width'],
									product_model::HEIGHT 	=> $image_info['image_height'],
									product_model::NAME 	=> $this->input->post('name'),
									product_model::DESCRIBE => $this->input->post('describe')
								);
				$re = $this->product_model->insert_entry($entry);
				if(!$re)
					$res[IUser::RES_CODE] = "101";
	  		}
		}

		echo json_encode($res);
	}

	function add_product_image() {
		$res = array( IUser::RES_CODE => '1');
		$uid = $this->input->post('uid');
		$pid = $this->input->post('pid');
		$utype = $this->input->post('utype');
		$session_id = $this->input->post(self::SESSION_ID);
		$add_time = now();
		$field_name = IProduct::UPLOAD_FIELD_NAME;
		$year_month = date('Ym',$add_time);
		$full_path = $_SERVER['DOCUMENT_ROOT'].$this->config->item('project_name').IProduct::UPLOAD_PATH.'/'.$year_month;
		$this->load->helper('dir_helper');
		if(!$this->_doAuthBusi($session_id, $uid, $utype))
		{
			$res[IUser::RES_CODE]  = '201';
		}
		else if (!new_dir($full_path)) {
			$res[IUser::RES_CODE]  = '202';			//无法创建文件夹		
		}
		else if (!$this->_product_exist($uid, $pid)) {
			$res[IUser::RES_CODE]  = '203';
		}
		else 
		{
			// 上传图片到服务器
			$field_name = IProduct::UPLOAD_FIELD_NAME;
			$arr_name = explode(".", $_FILES[$field_name]['name']);
			$config['upload_path'] = '.'.IProduct::UPLOAD_PATH.'/'.$year_month.'/';
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
				$this->load->model('product_image_model');
				$image_entry = array(
									product_image_model::URI 	=> $image_url,
			  						product_image_model::PID 	=> $pid,
			  						product_image_model::ORDER 	=> 2,
			  						product_image_model::WIDTH 	=> $image_info['image_width'],
									product_image_model::HEIGHT => $image_info['image_height']
								);
				$re = $this->product_image_model->insert_entry($image_entry);
				if(!$re)
					$res[IUser::RES_CODE] = "101";
	  		}
		}

		echo json_encode($res);
	}


	function _product_exist($uid, $pid) {
		$this->load->model('product_model');
		$arr = array(
 				product_model::ID => $pid,
 				product_model::MID => $uid
 				);
		if($this->product_model->product_exist($arr))
			return TRUE;
		else
			return FALSE;
	
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
	 * 验证sessionid
	 * @author fanz <251327341@qq.com>
	 * @param string $sessionid $Busi_id
	 * @return boolean 
	 * 				true 	token验证合法
	 *				false 	token验证不合法
	 * @todo
	 * @access private
	 */
	private function _doAuthBusi($sessionid = '', $user_id = '', $type = 1) {

		if($this->_doAuthUser($sessionid, $user_id)) {
			$arr = array(
					user_model::ID => $user_id,
					user_model::TYPE => $type
					);
			$res = $this->user_model->user_exist($arr);
			return $res;
		} else {
			return false;
		}
	}







}

/* End of file business.php */
/* Location: ./application/controllers/business.php */