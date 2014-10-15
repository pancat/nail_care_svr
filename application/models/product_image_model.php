<?php
	
 /**
 * Product image Model
 * A class provided some methods to CURD data in talbe fr_product_image
 * Created on 2014/10/15
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Product_image_model extends CI_Model {

 	const TABLE_NAME 	= 'fr_product_product';


 	const ID 		= 'id';
 	const URI 		= 'uri';
 	const HEIGHT 	= 'height';
 	const WIDTH 	= 'width';
 	const PID 		= 'pid';
 	const ORDER 	= 'order';

 	function __construct() 
 	{
 		parent::__construct();
 	}


 }



/* End of file product_model.php */
/* Location: ./application/model/product_model.php */