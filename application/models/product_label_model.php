<?php
	
 /**
 * Product label Model
 * A class provided some methods to CURD data in talbe fr_product_label
 * Created on 2014/10/15
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Product_label_model extends CI_Model {

 	const TABLE_NAME 	= 'fr_product_label';


 	const ID 		= 'id';
 	const PID 		= 'pid';
 	const LID 		= 'lid';

 	function __construct() 
 	{
 		parent::__construct();
 	}


 }



/* End of file product_model.php */
/* Location: ./application/model/product_model.php */