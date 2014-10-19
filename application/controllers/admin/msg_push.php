<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Msg_push developer controller
 * 
 * Created on 2014/10/16
 * @author 
 * @version 0.1
 * @copyright Pancat
 */
class Msg_push extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	
}


/* End of file msg_push.php */
/* Location: ./application/controllers/admin/msg_push.php */
