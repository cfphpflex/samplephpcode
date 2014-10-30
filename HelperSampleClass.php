<?php
/** example showing how to make a helper function
 * Make a helper function or use built in get_hostname  function to get the environtments hostname
 * first test if the function not exist, then proceed to load function
 * this addresses the the basic need to know what environment code is running for configuration purposes
 * gets the hostname from the server scope and returns the hostname in teh $field variable
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
