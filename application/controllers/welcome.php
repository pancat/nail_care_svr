<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @name 名字
 * @abstract 声明明变量/类/方法
 * @access 指明这个变量、类、函数/方法的存取权限
 * @author 函数作者的名字和邮箱地址
 * @category 组织packages
 * @copyright 指明版权信息
 * @const 指明常量
 * @deprecate 指明不推荐或者是废弃的信息
 * @example 示例
 * @exclude 指明当前的注释将不进行分析，不出现在文挡中
 * @final 指明这是一个最终的类、方法、属性，禁止派生、修改。
 * @global 指明在此函数中引用的全局变量
 * @include 指明包含的文件的信息
 * @link 定义在线连接
 * @module 定义归属的模块信息
 * @modulegroup 定义归属的模块组
 * @package 定义归属的包的信息
 * @param 定义函数或者方法的参数信息
 * @return 定义函数或者方法的返回信息
 * @see 定义需要参考的函数、变量，并加入相应的超级连接。
 * @since 指明该api函数或者方法是从哪个版本开始引入的
 * @static 指明变量、类、函数是静态的。
 * @throws 指明此函数可能抛出的错误异常,极其发生的情况
 * @todo 指明应该改进或没有实现的地方
 * @var 定义说明变量/属性。
 * @version 定义版本信息
 */

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	//test
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