<?php
/**
 * CodeIgniter HELPER
  
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

     

if (!function_exists('my_host'))
{

  function my_host()

	 { 
	 	 //	public  $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')=== FALSE ? 'http' : 'https';
	 		  
	 		 $params   = $_SERVER['QUERY_STRING'];
                  	$field['url'] 		=  	$field['protocol']  . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
			 
			  	
			return $field; 		 
						
	}	   
}		
		
	 			
			
	 
	 


?>
