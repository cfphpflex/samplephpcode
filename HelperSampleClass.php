<?php
/**
 * CodeIgniter
 Helper example 
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

     

if (!function_exists('my_host'))
{

  function my_host()

	 { 
	 	 //	public  $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')=== FALSE ? 'http' : 'https';
	 		 $host     = $_SERVER['HTTP_HOST'];
	 		 $script   = $_SERVER['SCRIPT_NAME'];
	 		 $params   = $_SERVER['QUERY_STRING'];
             
			$field['protocol'] 	= 	strpos($_SERVER['DOCUMENT_ROOT'], '443') !== false ? 'https://' : 'http://';
			$field['localhost'] = 	$field['protocol'] . $_SERVER['HTTP_HOST'];
			$field['url'] 		=  	$field['protocol']  . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
			 
			  	
			return $field; 		 
						
	}	   
}		
		
	 			
			
	 
	 


?>
