<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class ICircle {
	/**
	 * 外部接口字段名
	 */
	const ID       = 'cricle_id';
	const UID      = 'uid';
	const TITLE    = 'title';
	const CONTENT  = 'content';
	const HIT      = 'hit';
	const CRE_DATE = 'cre_date';
	const IMAGE    = 'image_uri';



	const UPLOAD_FIELD_NAME 	= 'uploadfile';
	const UPLOAD_PATH 			= './assets/res/circle_images';
}

/* End of file ICircle.php */