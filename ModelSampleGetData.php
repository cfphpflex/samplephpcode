<?php
/**
 *Simple one stop shopping model sample  to search for records, catch errors, return records as JSON Payload
 * Wrote this to show how one file can candle the CRUD conditioanally
 * The file receives a post froma form
 * and the post is processed according to what the form posted
 * a basic try/catch is implemented to 
 * returns records found as JSON payload
 
 */
	 
	 
	 	    
	try{
	             
	 
	
// DECLARE 	MYSQL HOST INFO
	    	$this ->hostIP = "127.0.0.1";	// API
		$this ->id = 0;            		// id
		$this ->UserName= "that";  		// admin usr for db
	 	//DECLARE Default Params
		 	
	
// DECLARE  PARAM DEFAULTS
	 	$this -> page 		= isset($_POST['page'])?$_POST['page']:1;   	 //Page user is on
	              
	 	// 1.  DB connection
		$this->_db = new PDO("mysql:dbname=hrportal;host=$this->hostIP", "that", "");
	                      
		// update record by
		$update = (isset($_POST['oper']))?$_POST['oper'] : 0 ;

	        // upddate record by id
		id = isset($_POST['id'])?$_POST['id'] : 0 ;
     			
     		// upddate record by
		$SomethingName = isset($_POST['Something_name_vc'])?$_POST['Something_name_vc'] : 0 ;
    		// set a debug variable
    		$debug = isset($_GET['debug'])?$_GET['debug'] : 0 ;
   		 
	        //order by
	        $sidx = (isset($_POST['sidx']))?$_POST['sidx'] : 'Something_name_vc';
		// sort by
		$sord = (isset($_POST['sord']))?$_POST['sord'] : 'ASC';
  		  
 		// 1. SQL stmnt prepare to prevent injection plus form should have filtered data being sent via validation
		$sql = $this->_db->prepare("  select Something_id, Something_name_vc   from Somethings      order by {$sidx}   {$sord}  ");      
		// 2. Execute		
		$sql->execute();
		// 3. GET Records
		$getRecords = $sql->fetchAll();
   						  

   				 
//*** DEFAULT  GET  ALL RECORDS   
	 			if( isset($_POST['_search'])  &&    $_POST['_search'] === 'false'   )   { 
	  	
					// 1. SQL stmnt
						$sql = $this->_db->prepare("  select Something_id, Something_name_vc   from Somethings      order by {$sidx}   {$sord}  ");      
					// 2. Execute		
					   	$sql->execute();

		        	 	// 3. GET Records
		            		$getRecords = $sql->fetchAll();
					//var_dump($getRecords);
 			
				}
//*************END DEFAULT

  				  
  
  
   

//******* JSON package records found   
		     	if ( isset($getRecords)  &&   is_array($getRecords)   ) {  
		        	 echo json_encode($getRecords);
		        		       	
			        }
		        else { echo " no records ";   }
	
				
	//**** ***END UPDATE

							        
							    	                      
	        }catch(\PDOException $e){
	            echo $e->getMessage();
	}
	    	 
	    
	  
	    
    
?>

