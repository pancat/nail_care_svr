<?php

/*
 * @author JogRunner
 * @function upload file using uploadify tool
 * @version 1.0.0
 * @company pancat
 */

class Upload extends CI_Controller{
	var $movepath = "";
	var $storageModel = "pancat_model/fileupload_model";
	var $model = "Fileupload_model";
	
	public function __construct(){
		parent::__construct();
		$this->load->model($this->storageModel);
		//from config/project.php load config['upload_site']
		$this->config->load('project');
		if($this->config->item('upload_site'))
			$this->movepath = $this->config->item('upload_site');
		if(!$this->movepath)
			$this->movepath =$_SERVER['DOCUMENT_ROOT'].'/'.$this->config->item('project_name').'/download/';
	}
	
	public function uploadfile(){
		
		// $js = $this->config->item('base_url').'/js/';
		
		// $this->load->helper('pancatarray');
		// $data['js'] = addprefix($js.'uploadify/',array('jquery.uploadify.js'));
		// $data['js'] = array_merge((array)($js.'common./jquery.js'),$data['js']);
		$data_head['title'] = '上传文件';
		// $data['swf'] = $this->config->item('base_url').'/assets/res/video/uploadify.swf';
		
		// $data['page'] = site_url('pancat/upload/handle');
		$data['topage'] = site_url('Pancat/upload/scan');
		// $data['css'] = addprefix($this->config->item('base_url').'/css/uploadify/upload',array('.css','ify.css'));
		
		$this->load->view('template/header',$data_head);
		$this->load->view('upload/uploadfile',$data);
		$this->load->view('template/footer');
		
		//print_r($data['js']);
		
	}
	public function handle()
	{
		
		$this->load->helper('date');
		if(!empty($_FILES))
		{
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetFilePath = $this->movepath.'apk/'.$_FILES['Filedata']['name'];
			$targeturl = $this->config->item('base_url').'/download/apk/'.$_FILES['Filedata']['name'];
			if(file_exists($targetFilePath)){
				echo '0'.'file already exits';
				return ;
			}

			if(move_uploaded_file($tempFile,$targetFilePath))
			{
				//transfer database
				date_default_timezone_set('PRC');
				$data[Fileupload_model::FILE_NAME] = $_FILES['Filedata']['name'];
				$data[Fileupload_model::FILE_DOWNLOAD_ADDR] = $targeturl;
				$data[Fileupload_model::FILE_SIZE_KB] = (int) ($_FILES['Filedata']['size'] /1024);
				$data[Fileupload_model::FILE_UPLOAD_TIME] = date('Y-m-d H:i:s');
				$data[Fileupload_model::FILE_TWODIM_IMAGE_ADDR] = site_url('pancat/upload/twodim/');
				$data[Fileupload_model::FILE_TYPE] = 'apk';
				
				$this->fileupload_model->insert_fileinfo($data);
				echo '1'.$targetFilePath;
				return ;
			}
			else {
				echo '0,upload file failed.'.$targetFilePath;
			}
			
		}
		else
		{
			echo '0, upload file is empty!';
		}
		// echo '0';
	}
	
	public function _remap($method =""){
		if($method)
		{
			$this->$method(func_get_args());
		}
		else 
			$this->handle();
	}
	
	public function scan(){
		
		// $js = $this->config->item('base_url').'/assets/js/';
		// $css = $this->config->item('base_url').'/assets/css/';
		
		$data['fileinfo'] = $this->fileupload_model->select_from_filename();
		$data['title'] = '资源下载页面';
		// $data['js'] = array($js.'common/jquery.js');
		// $data['css'] = array($css.'uploadify/showfile.css');
		
		$this->load->view('template/header',$data);
		$this->load->view('upload/resource',$data);
		$this->load->view('template/footer');
	}
	public function twodim($id=1){
		if(is_array($id) && isset($id[1]))
			$id = $id[1][0];
		$this->load->library('qrcodelib');
		$url = $this->fileupload_model->geturl($id);
		if($url)
			echo QRcode::png($url,false,QR_ECLEVEL_Q);
		else echo 'error';
	}
}