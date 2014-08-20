<?php
/**
 * CodeIgniter
 Model simple  example 
 */
	

	 		// ENV
 			$this ->environment 	= isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';   //Page user is on
			
		 
	 		// DECLARE 	MYSQL HOST INFO
		    $this ->hostIP = "127.0.0.1";	// API
			$this ->id = 0;            		// id
			$this ->UserName= "root";  		// admin usr for db
		 	//DECLARE Default Params
		 	
		 	 
		 		/*	foreach ( $_POST as $var => $val)
		 			{
		 				$this -> $var 			= isset($_POST['$var'])?$_POST['$val']:"";   	 //Page user is on
		 			}
		 	   */
		 	
		 	// DECLARE SEARCH PARAM DEFAULTS
		 	$this -> page 			= isset($_POST['page'])?$_POST['page']:1;   	 //Page user is on
		 	$this -> rows 			= isset($_POST['rows'])?$_POST['rows']:10;  	//Number of Rows to display per page
		 	$this -> sidx 			= isset($_POST['sidx'])?$_POST['sidx']:"";  	//Sort Column
		 	$this -> sord 			= isset($_POST['sord'])?$_POST['sord']:"ASC";  //Sort Order
		 	$this -> nd 			= isset($_POST['nd'])?$_POST['nd']:0;    
		 	$this -> _search 		= isset($_POST['_search'])?$_POST['_search']:false;  		//Whether search is performed by user on data grid
		 	$this -> searchField 	= isset($_POST['searchField'])?$_POST['searchField']:"";  	//Field to perform Search on
		 	$this -> searchOper 	= isset($_POST['searchOper'])?$_POST['searchOper']:"";  	//Search Operator Short Form"
		 	$this -> searchString 	= isset($_POST['searchString'])?$_POST['searchString']:"";   //Search Text
		  
		  	$this -> arrUsers 	= array(); 
		    $this -> strMsg 	= "";
		    $this -> strMsgType 	= "success";
		    $this -> records 	= "";
		    $this -> blnSearch 	= "";
		    $this -> strMsg 	= false;
		    $this -> strSearch 	= "";
		    
		    
		    
		    
			 try{
	               //Production
	               //$this->_db = new PDO("mysql:dbname=hrportal;host=$hostIP", "root", "$4@2@m!HW");
	               
	              // Development 
	              
	 			// 1.  DB connection
				 $this->_db = new PDO("mysql:dbname=hrportal;host=$this->hostIP", "root", "");
	              //$this->_db = new PDO("mysql:dbname=hrportal;host=$hostIP", "root", "");
        			//Debug
        			//echo("pdo connectiond done". "<br>");
        
	                     
		        // upddate record by
		         $update = (isset($_POST['oper']))?$_POST['oper'] : 0 ;

		 	    // upddate record by
		          $id = isset($_POST['id'])?$_POST['id'] : 0 ;
     			// upddate record by
		          $SomethingName = isset($_POST['Something_name_vc'])?$_POST['Something_name_vc'] : 0 ;
    
    			 $debug = isset($_GET['debug'])?$_GET['debug'] : 0 ;
   				 
      			//$curdate = date("d-m-Y");
	             $curdate = "2014-6-05";
	              
			 	//order by
		         $sidx = (isset($_POST['sidx']))?$_POST['sidx'] : 'Something_name_vc';
		         
		        // sort by
		         $sord = (isset($_POST['sord']))?$_POST['sord'] : 'ASC';
 
 				  
 				// 1. SQL stmnt
						$sql = $this->_db->prepare("  select Something_id, Something_name_vc   from Somethings      order by {$sidx}   {$sord}  ");      
						
			     
					// 2. Execute		
					   	$sql->execute();

		            // 3. GET Records
		            	$getRecords = $sql->fetchAll();
   						  

   				 
//************* DEFAULT  GET  ALL RECORDS   
	 			if( isset($_POST['_search'])  &&    $_POST['_search'] === 'false'   )   { 
	  	
					// 1. SQL stmnt
						$sql = $this->_db->prepare("  select Something_id, Something_name_vc   from Somethings      order by {$sidx}   {$sord}  ");      
						
			     
					// 2. Execute		
					   	$sql->execute();

		            // 3. GET Records
		            	$getRecords = $sql->fetchAll();
					//echo " no records ";   _search:false
					
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

