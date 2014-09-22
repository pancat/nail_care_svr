<?php
/*
 * @author JogRunner
 * @date 2014.09.21
 * @function some custom array handle function
 * @company pancat
 */

/*
 * @function addprefix
 * @example addprefix("localhost/project",array('a','b'),'/');
 * @output  array('localhost/project/a','localhost/project/b');
 */
if ( ! function_exists('addprefix'))
{
	function addprefix($prefix="",$value = array(),$sep='')
	{
		if(!$prefix)
			return $value;
		if(is_array($value))
		{
			$arr = array();
			foreach ($value as $v)
			{
			 	$arr[] = $prefix.$sep.(string)$v;
			}
			return $arr;
		}
		else return $prefix.$sep.(string)$value;
	}
}