<?php
/**
 * Make a helper function or use built in get_hostname  function to get the environtments hostname
 * this addresses the the basic need to know what environment code is running for configuration purposes
  
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
