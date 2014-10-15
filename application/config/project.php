<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//$config['twodimsavepath'] = $config['base'].'/download/';
$config['project_name'] = 'nail_care_svr';
$config['upload_site'] = $_SERVER['DOCUMENT_ROOT'].'/'.$config['project_name'].'/download/'; //absolute path


$config['header_json_utf8'] = 'Content-type: application/json; charset=utf-8';
$config['header_text_utf8'] = 'Content-type: application/text; charset=utf-8';

/**
 * 各模块公用
 */

$config['res_state'] 		= 'res_state';
$config['error_code'] 		= 'error_code';
// $config['cre_date'] 		= 'cre_date';
// $config['hit'] 				= 'hit';
// $config['image_uri'] 		= 'image_uri';


/**
 * 美甲师
 */
$config['m_id'] 			= 'm_id';
$config['m_name'] 			= 'm_name';


// /**
//  * 用户
//  */
// $config['u_id'] 			= 'u_id';
// $config['u_nickname'] 		= 'u_nickname';
// $config['u_type'] 			= 'u_type';
// $config['u_status'] 		= 'u_status';

// /**
//  * 产品模块外部接口字段名($value是外部接口的字段名称)
//  */
// $config['product_id'] 		= 'p_id';
// $config['product_name'] 	= 'name';
// $config['product_describe'] = 'p_describe';
// $config['product_hit'] 		= 'hit';
// $config['product_cre_date']	= 'cre_date';
// $config['product_image']	= 'image_uri';

/**
 * 圈子模块外部接口字段名
 */
// $config['circle_id']		= 'cricle_id';
// $config['circle_title']		= 'title';
// $config['circle_content']	= 'content';
// $config['circle_hit'] 		= 'hit';
// $config['circle_cre_date']	= 'cre_date';
// $config['circle_image']		= 'image_uri';


/**
 * 圈子评论 外部接口字段名
 */
$config['comment_id']		= 'comment_id';
$config['comment_cid']		= 'comment_cid';
$config['comment_uid']		= 'comment_uid';
$config['comments']			= 'comments';
$config['comment_cre_date']	= 'comment_cre_date';