<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class IUser {
	/**
	 * 外部接口字段名($value是外部接口的字段名称)
	 */
	const RES_CODE 			= 'code';
	const ID 				= 'id';
	const USER_NAME 		= 'username';
	const PSD 				= 'password';
	const NICK_NAME 		= 'nick_name';
	const AGE 				= 'age';
	const EMAIL 			= 'email';
	const ADDR 				= 'address';
	const AVATAR_URI 		= 'avatar_uri';
	const REG_DATE 			= 'register_date';
	const LAST_LOGIN 		= 'last_login';
	const LAST_IP 			= 'last_ip';
	const STATUS 			= 'status';
	const LEVEL 			= 'level';
	const REMARK 			= 'remark';

	const UPLOAD_AVATAR_FIELD 			= 'uploadavatar';
	const UPLOAD_AVATAR_PATH 			= '/assets/res/user_avatar';
}

/* End of file IUser.php */