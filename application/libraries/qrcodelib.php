<?php if( !defined('BASEPATH')) exit('No direct script access allowed');
class QrCodeLib
{
	public function __construct(){
		require_once APPPATH.'third_party/phpqrcode/qrlib.php';
	}
	
	public function outputTwoDimToFile($encode_str,$savepath = NULL ){
		if($savepath === NULL){
				
		}
	}
}