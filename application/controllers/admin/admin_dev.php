<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin developer controller
 * 
 * Created on 2014/10/16
 * @author fanz <251327341@qq.com>
 * @version 0.1
 * @copyright Pancat
 */
class Admin_dev extends CI_Controller {


	/**
	 * session的字段名
	 */
	const SESSION_ID 		= 'sessionid';
	const SESSION_UID 		= 'uid';
	const SESSION_DATE 		= 'last_date'; 

	
	const HEAD = 'admin/head';
	const NAVBAR_SIGN = 'admin/navbar_sign';
	const SIGN_IN = 'admin/sign_in';
	const SIGN_UP = 'admin/sign_up';
	const NAVBAR_MAIN = 'admin/navbar_main';
	const SIDEBAR = 'admin/sidebar';
	const MAIN = 'admin/main';
	const FOOTER = 'admin/footer';	

	const TUSER = 'admin/tuser';
	const TCIRCLE = 'admin/tcircle';
	const TPRODUCT = 'admin/tproduct';

	const MSG_PUSH = 'admin/msg_push';

	const USER_NAME = 'username';
	const PSD 		= 'psd';
	const EMAIL  	= 'email';
	const NICK_NAME = 'nickname';

	public $sessionid = '';

	function __construct() {
		parent::__construct();
		$this->load->config('admin');
		$this->load->model('admin_model');
		// $this->load->model('admin_model');
		//session_start();
	}


	function index()
	{
		$this->login();
	}

	function login() {
		if($this->input->post(self::USER_NAME)) {
			$this->_init_login_validate();
			if($this->form_validation->run() == FALSE) {
				echo $this->input->post(self::USER_NAME).' ';
				echo $this->input->post(self::PSD);
				$this->show_register(array('error' => validation_errors()));
			} 
			else {
				
				$entry = array(
						admin_model::USER_NAME => $this->input->post(self::USER_NAME),					
						admin_model::PSD => $this->input->post(self::PSD)
					);
				$res = $this->admin_model->get_admin_by_np($entry);
				if($res != FALSE) {
					$data = array(
								'username' => $res[admin_model::USER_NAME],
								'nickname' => $res[admin_model::NICK_NAME]
							);
					$this->show_main($data);
				}
			}
		} else {
			$this->show_register();

		}
	}

	function register() {
		if($this->input->post(self::USER_NAME)) {
			$this->_init_login_validate();
			if($this->form_validation->run() == FALSE) {
				echo $this->input->post(self::USER_NAME).' ';
				echo $this->input->post(self::PSD);
				$this->show_register(array('error' => validation_errors()));
			} 
			else {
				
				$entry = array(
						admin_model::USER_NAME => $this->input->post(self::USER_NAME),
						admin_model::NICK_NAME => $this->input->post(self::NICK_NAME),
						admin_model::PSD => $this->input->post(self::PSD),
						admin_model::LEVEL => 0
					);

				if($this->admin_model->insert_entry($entry))
					$this->show_login(array('info' => '注册成功！请登陆。'));
			}
		} else {
			$this->show_register();

		}
	}

	function show_register($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_SIGN);
		$this->load->view(self::SIGN_IN, $data);
	}

	function show_login($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_SIGN);
		$this->load->view(self::SIGN_UP, $data);
	}

	function show_main($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_MAIN, $data);
		$this->load->view(self::SIDEBAR);
		$this->load->view(self::MAIN);
		$this->load->view(self::FOOTER);
	}

	function show_tuser($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_MAIN);
		$this->load->view(self::SIDEBAR);
		$this->load->view(self::TUSER);
		$this->load->view(self::FOOTER);
	}

	function show_tcircle($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_MAIN);
		$this->load->view(self::SIDEBAR);
		$this->load->view(self::TCIRCLE);
		$this->load->view(self::FOOTER);
	}

	function show_tproduct($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_MAIN);
		$this->load->view(self::SIDEBAR);
		$this->load->view(self::TPRODUCT);
		$this->load->view(self::FOOTER);
	}


	function show_msg_push($data = array()) {
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR_MAIN);
		$this->load->view(self::SIDEBAR);
		$this->load->view(self::MSG_PUSH);
		$this->load->view(self::FOOTER);
	}

	

	/**
	 * 登录注册验证规则的初始化
	 * @author fanz <251327341@qq.com>
	 * @todo 修改用户名规则
	 */
	private function _init_login_validate() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules(self::USER_NAME, '用户名', 'trim|required|is_natural|min_length[1]|xss_clean');
		$this->form_validation->set_rules(self::PSD, '密码', 'trim|required|md5');
	}



}

/* End of file admin_dev.php */
/* Location: ./application/controllers/admin/admin_dev.php */