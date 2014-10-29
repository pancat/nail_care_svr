<?php
	
 /**
 * Comment Model
 * A class provided some methods to CURD data in talbe fr_circle_comments
 * Created on 2014/10/10
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Circle_image_model extends CI_Model {

 	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME = 'fr_circle_image';
 	// const USER_TABLE = 'fr_user';

 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */

 	const ID    = 'id';
 	const URI   = 'uri';
 	const WIDTH = 'width';
 	const HEIGHT = 'height';
 	const CID   = 'cid';
 	const ORDER = 'order';
 	// const cre_date = 'cre_date';

 	function __construct() 
 	{
 		parent::__construct();
 	// 	$this->load->model('user_model');
 	// 	$this->load->model('circle_comment_model');
 	// 	$this->load->model('circle_image_model');
 	// 	$this->load->library('IUser');
 	// 	$this->load->library('ICircle');
 	// 	$this->load->library('ICirComment');
		$this->load->library('ICirImage');
 		// $this->load->library('IUser');

 	}

 	/**
 	 * Insert a circle's comment item 
 	 * Created on 2014/10/15
 	 * @param array $arr =
 	 *				int 		'comment_uid'  				登录id
 	 * 				int 		'comment_cid' 				圈子id
 	 *				string 		'comments' 					评论内容
 	 * @return  boolean 	true 	插入数据成功
 	 * 			boolean 	false 	失败
 	 */
 	function insert_entry($entry)
 	{
 		$this->db->insert(self::TABLE_NAME, $entry);
 		log_message('debug', $this->db->last_query());
 		if($this->db->affected_rows() > 0)
 			return $this->db->insert_id();
 		else
 			return FALSE;
 	}

 	/**
 	 * Get a circle images info
 	 * Created on 2014/10/01
 	 * @param int $circle_id 
 	 * @return  array 查询成功返回对象数组
 	 * 			boolean 失败
 	 */
 	function get_circle_images($circle_id = 0)
 	{
 		$select = 
 			self::TABLE_NAME.'.'.self::URI.' as '.ICirImage::URI.', '.
 			self::TABLE_NAME.'.'.self::ORDER.' as '.ICirImage::ORDER;
 		$this->db->select($select);
 		$this->db->from(self::TABLE_NAME);
 		$this->db->where(circle_image_model::CID.' = '.$circle_id);
 		$res = $this->db->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}

 	function get_images($circle_id)
 	{
 		$this->db->select(array(
 				self::TABLE_NAME.'.'.self::URI => ICirImage::URI,
 				self::TABLE_NAME.'.'.self::ORDER => ICirImage::ORDER
 			));
 		$this->db->from(self::TABLE_NAME)->where(array(self::CID => $circle_id))->get();
 		log_message('debug', $this->db->last_query());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}

 	/**
 	 * Delete a circle image item 
 	 * Created on 2014/10/15
 	 * @param array $arr =
 	 *				int 		'id'  				id
 	 * @return  boolean 	true 	成功
 	 * 			boolean 	false 	失败
 	 */
 	function delete_entry($arr)
 	{
 		$this->db->delete(self::TABLE_NAME, $arr);
 		log_message('debug', $this->db->last_query().'; comment_id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
 		if($this->db->affected_rows() > 0)
 			return TRUE;
 		else
 			return FALSE;
 	}

 }


 /* End of file circle_image_model.php */
/* Location: ./application/model/circle_image_model.php */