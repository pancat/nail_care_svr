<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//$config['twodimsavepath'] = $config['base'].'/download/';
$config['project_name'] = 'nail_care_svr';
$config['upload_site'] = $_SERVER['DOCUMENT_ROOT'].$config['project_name'].'/download/'; //absolute path


$config['res_state'] 		= 'res_state';
$config['error_code'] 		= 'error_code';

/**
 * 产品模块外部接口字段名($value是外部接口的字段名称)
 */
$config['product_id'] 		= 'p_id';
$config['product_name'] 	= 'name';
$config['product_discribe'] = 'discribe';
$config['cre_date'] 		= 'cre_date';
$config['hit'] 				= 'hit';
$config['image_uri'] 		= 'image_uri';
$config['m_id'] 			= 'm_id';
$config['m_name'] 			= 'm_name';


/**
 * 圈子模块外部接口字段名
 */