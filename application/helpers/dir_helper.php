<?php
/*
 * @author JogRunner
 * @date 2014/10/29
 * @
 * @company pancat
 */

if ( ! function_exists('new_dir'))
{
	function new_dir($full_path) {
		log_message('debug', "mkdir in ".$full_path);
 		if(is_dir($full_path) == TRUE)
 			return TRUE;
 		else {
 			if(mkdir($full_path, 0777))
 				return TRUE;
 			else
 				return FALSE;
 		}
 	}
}