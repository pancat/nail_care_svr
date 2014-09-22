<?php
/*
 * @author JogRunner
 * @about file information table: exp_pancat_file_information
 * @build: version 1.0.0 at 2014.9.19
 * @company pancat
 */

class Fileupload_model extends CI_Model{
	/*
	 * column name
	 */
	const TABLE_NAME = "exp_pancat_file_information";
	const FILE_ID = "file_id";
	const FILE_NAME = "file_name";
	const FILE_DOWNLOAD_ADDR = "file_download_addr";
	const FILE_SIZE_KB = "file_size_kb";
	const FILE_UPLOAD_TIME = "file_upload_time";
	const FILE_TWODIM_IMAGE_ADDR = "file_twodim_image_addr";
	const FILE_TYPE = "file_type";
	const FILE_UPLOAD_AUTHOR = "file_upload_author";
	const FILE_DOWNLOAD_COUNT = "file_download_count";
	const FILE_ENABLED_UPDATE = "file_enabled_update";
	const FILE_ENABLED_DELETE = "file_enabled_delete";
	const FILE_SHARE_AUTHORITY = "file_share_authority";
	
	public static $ClassName = "Fileupload_model";
	/*
	 * @construct function
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/*
	 * @select rows from table where filename = $param
	 */
	public function select_from_filename($param = FALSE)
	{
		// select all
		if($param === FALSE)
		{
			$query = $this->db->get(self::TABLE_NAME);
			return $query->result_array();
		}
		else 
		{
			$query = $this->db->get_where(self::TABLE_NAME,array(self::FILE_ID => $param));
			return $query->result_array();
		}
	}
	
	/*
	 * @select url from table where id = $id
	 */
	public function geturl($id)
	{
		$query = $this->db->get_where(self::TABLE_NAME,array(self::FILE_ID => $id));
		if($query->num_rows() > 0)
		{
			$arr = $query->row_array();
			return $arr[self::FILE_DOWNLOAD_ADDR];
		}
		return FALSE;
	}
	
	/*
	 * @insert one app information 
	 * @param file information,must be inclue the following param
	 *       param['file_name'],
	 *       param['file_download_addr']
	 *       param['file_size_mb']
	 *       param['file_upload_time']
	 *       param['file_twodim_image_addr']
	 *       param['file_type']
	 *       param['file_upload_author']
	 */
	public function insert_fileinfo($param=array())
	{
		return $this->db->insert(self::TABLE_NAME,$param);	
	}
	
	
} 