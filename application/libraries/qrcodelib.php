<?php if( !defined('BASEPATH')) exit('No direct script access allowed');
class QrCodeLib
{
	public function __construct(){
		require_once APPPATH.'third_party/phpqrcode/qrlib.php';
		log_message('debug', 'qrcodelib Library Initialized!.');
	}
	
	public function outputTwoDimToFile($encode_str,$savepath = NULL ){
		if($savepath === NULL){
				
		}
	}
}