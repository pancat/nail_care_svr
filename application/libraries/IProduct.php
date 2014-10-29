<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class IProduct {
	/**
	 * 产品模块外部接口字段名($value是外部接口的字段名称)
	 */
	const ID 					= 'p_id';
	const NAME 					= 'name';
	const DESCRIBE 				= 'p_describe';
	const HIT 					= 'hit';
	const CRE_DATE				= 'cre_date';
	const IMAGE   				= 'image_uri';
	const IMAGE_WIDTH   		= 'image_width';
	const IMAGE_HEIGHT   		= 'image_height';

	const UPLOAD_FIELD_NAME 	= 'uploadfile';
	const UPLOAD_PATH 			= '/assets/res/product_images';

}

/* End of file IProduct.php */


