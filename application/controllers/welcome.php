<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		//这里应该是是从Mysql数据库中得到相应的数据，
		//这里仅仅是模拟过程，不再写相应的数据库交互代码
		$username = str_replace(" ", "", $_GET['username']);
		$password = str_replace(" ", "", $_GET['password']);
		$id = 1;

		//将数据存储到数据中
		$arr = array(
			'user_id' => $id,
			'user_name'=>$username,
			'password' =>$password
		);

		//将数组转成json格式进行传递
		$strr = json_encode($arr);

		echo($strr);

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */