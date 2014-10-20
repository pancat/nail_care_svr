<?php
	
 /**
 * Label Model
 * A class provided some methods to CURD data in talbe fr_label
 * Created on 2014/10/19
 * @author fanz <251327341@qq.com> 
 * @version 0.1
 * @copyright Pancat
 */


 class Label_model extends CI_Model {



 	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME 		= 'fr_label';

 	/**
 	 * 表字段的名称(上面表中的字段名称)
 	 * @var array
 	 */
 	const ID          = 'id';
 	const NAME        = 'name';


 	function __construct()
 	{
 		parent::__construct();
 	}

 	function get_all_labels()
 	{
 		$select = self::TABLE_NAME.'.'.self::ID.' as '.ILabel::ID.', '.
 					self::TABLE_NAME.'.'.self::NAME.' as '.ILabel::NAME;
 		$res = $this->db->select($select)->from(self::TABLE_NAME)->get();
 		if($res->num_rows() >= 1)
 			return $res->result_array();
 		else
 			return FALSE;
 	}

}

/* End of file label_model.php */
/* Location: ./application/model/label_model.php */