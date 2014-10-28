<?php

   
/**  PREVENT CYCLIC GROUP REFERENCES
 
 
 Here’s the last part of the groups database model we discussed at the end of the code test.
 
Given:
-          Users can belong to groups

-          Groups can belong to other groups (thus creating a group hierarchy)

Problem:
               
 
-          Prevent cyclic group relations when inserting a new parent-child relationship.

o   Ex. If A > B > C > D, then the following are not allowed: B > A, C > A, C > B, D > A, D > B, D > C

o   A > D is okay, B > F is okay

-          Implement function createParentChildRelationship($parent, $child)

-          Return true if successful, or false if the parent-child relationship is not allowed.

 


  Ex. If A > B > C > D, then the following are not allowed: B > A, C > A, C > B, D > A, D > B, D > C
  A > D is okay, B > F is okay

Convert A-g to numbers for ease of use in indexed array:
A=1
B=2
C=3
D=4
E=5
F=6
g=7


Parent:child linked list relationship
OK = 1>2>3>4>5>6>7>8>9>10
BAD= 2>1 to reverse parent child relationship for existing parent child relationship
b= parent  2
a =child   1

--1.  get all parent to child relationships

 
    
 **/
   
    
    
 
  //model function calling host function to define which env database to create db  pdo connection for 
   public function dbmodel(){
        try{    
				$ci=& get_instance(); 
				$ci->load->model('host');
				$myHost = $ci->host->myhost();  // inst. above function_exists(string function_name)
				
				// IF what SERVER???  Dev or STAGE or Prod
 				if (  $myHost['localhost']  == 'http://localhost'  )
 				     { 	$db =  new PDO("mysql:dbname=sonyplayparentchild;host=127.0.0.1", "root", "");	  return $db;	}  // DEV & STAGE SSERVER
 				else {  
 						$db =  new \PDO("mysql:dbname=hrportal;host=localhost", "root", "mysecret");  return $db; 
 					 }  //PRODUCTION SERVER
    			//END IF
		  } catch( Exception $e ) { return ($e->getLine() . ": " . $e->getMessage() . " : \n" . $e->getTraceAsString()); }  //CATCH END

     
    }// END FUNCTION
    
 
	// START SQL CONN, STMT PREP, EXECUTE, FETCH, RETURN RECORDS
	public function  getAllRecords ($SQL) {
		try {
			$ci=& get_instance(); 
			$ci->load->model('host');
			$myHost = $ci->host->myhost();  		// inst. above function_exists(string function_name)
	        $db = $this->dbmodel();
	      
			$sql = $db->prepare($SQL);				// 2. PREP SQL STMT			
			$sql->execute();  						// 3. Execute SQL STME	
			$getallrecords = $sql->fetchAll();  		// 4. GET Records	
			return $getallrecords;  					// 5. RETURN ALL RECORDS
						 
		  } catch( Exception $e ) { return ($e->getLine() . ": " . $e->getMessage() . " : \n" . $e->getTraceAsString()); }  //CATCH END
 
	}  // END FUNCTION
	 	 
	 


	// START foreach record's b.group_id parent as  key => pass  var child value
	//The closest PHP likeness to the ArrayList class from Java is the ArrayObject class.
	public function  setParentChildArray ($MasterParentChildRecords, $parentSearchFor, $childSearchFor) {
		try {
		
			foreach($MasterParentChildRecords as $parentID => $childKey)  {
				   $newParentChildArray{$parentID} = array(); //set new array for each parent 
				   $parentfromChild  = $childKey; //Set new parent
				   do { 
				        //getnextsetof children
				       	$newChildrenListofChildThatisParent = $GetSQLChildasParent ($parentfromChild); //CALL function, pass sql children of parent 
				       	//that was child records  matching child value , set children list to continue this do while 
					    
					    // hadle single child of parent
					    if(sizeof($newChildrenList) == 1) {
					    	$newParentChildArray{$parentID} = $newParentChildArray{$parentID}[] ;
					    }
					    
					    // hadle multiple children to one parent  as array of array
					    else if (sizeof($newChildrenList) > 1) {
					    	foreach($newChildrenList as $newParentID => $newChild)
					    		$newParentChildArray.$parentID = $newParentChildArray.$parentID[ array[$newParentID] => $newChild ];
					     }
					    //arreayRecordkey append  parent => child  
					     set parent = child values for sql above
					   } 
					while (  sizeof($newChildrenListofChildThatisParent) > 0    // children list length > 0
					      );
			
			}
		
		
		 } catch( Exception $e ) { return ($e->getLine() . ": " . $e->getMessage() . " : \n" . $e->getTraceAsString()); }  //CATCH END
 
	}  // END FUNCTION
	 	 
	 	 
		




	public function  createParentChildRelationship ( $parent, $child) {
		
		
		try {

			//1. DB Connection 
			dbmodel(); 															// get db connection


			//SQL: MASTER: get all parent child relationships as datasource for linked list as implemented  or associative array
			$sqlAllParentChild  = "SELECT b.group_id AS 'groupParent ID',  a.group_id AS 'group_ID' 
			         FROM groupsb a, groupsb b  
			         WHERE a.groupParent_id = b.group_id
			         order by b.group_id ASC;"

			//2. get Master dataset of parent to child
			$masterParentChildRecordSet = getAllRecords($sqlAllParentChild);   	// get all parent child record set in  two column format


			
			//reset parent and child vars to more descriptive names
			isset($parentSearchFor) ? $parent : 2;
			isset($childSearchFor) ? $child : 1;
			 
			
			//SQL: MASTER: get all parent child relationships as datasource for linked list as implemented  or associative array
			$sqlAllParentChild  = "SELECT b.group_id AS 'groupParent ID',  a.group_id AS 'group_ID' 
			         FROM groupsb a, groupsb b  
			         WHERE a.groupParent_id = b.group_id
			         order by b.group_id ASC;"
			
			/* LOGIC  2. GOAL: Find  REVERSE child as parent records and parent as child in MASTER SQL result above Parent:child
			             Existing parent::child relationships = 1>2>3>4>5>6>7>8>9>10
			             BAD= 2>1  or 9>2 or 10>1 are not allowed as inserts, because this creates circular self-referencing relationships, 
			             defeating the purpose of this effort
			
			//SQL details 
			     		b table  = parent  2 // b having value of 2 reverses existing parent relationship and is not alloed to insert a record
				 		a table  = child   1 // a table having value of 1 reverses existing parent child relationship and is not allowe to insert
				 		test for 
			 
			 */
						 
		
			//SQL to get all parent child rel
			$sqlAllParentChild  = " SELECT b.group_id AS 'groupParent ID',  a.group_id AS 'group_ID' 
			  						FROM groupsb a, groupsb b  
			  						WHERE a.groupParent_id = b.group_id
			  						having  a.group_id = {$parentToSearchFor}  or b.group_id = {$childToSearchFor}
			  						order by b.group_id ASC;";
			
			
			//Calls to Functions and pass sql
				
			//3. Set Arrays of each parent to child  and all its sub parent to child relationships
			 setParentChildArray ($masterParentChildRecordSet);						//make arrays of all parent child relationships
			
			//4. loop on each array set to find if new child as a parent has index is less than the index of new parent as child if 
			 foreach($MasterParentChildRecords as $parentID )
			 
			   // if new parent id  exists as the the new child and to the new child id exists as a parent  and existing parent has an index less than child, return false
			  	if (  in_array($parentSearchFor, $newParentChildArray.$parentID )  &&   in_array($childSearchFor, $newParentChildArray.$parentID) &&
			  		  (  array_search($childSearchFor, $newParentChildArray.$parentID )  <  array_search($parentSearchFor, $newParentChildArray.$parentID ) ) {
				        return false;
				       } 
				// // if new parent id  exists as the the parent and to the new child id exists as a child  and existing parent has an index less than child, return true
				else if (  in_array($parentSearchFor, $newParentChildArray.$parentID )  &&   in_array($childSearchFor, $newParentChildArray.$parentID) &&
			  		  (  array_search($parentSearchFor, $newParentChildArray.$parentID )  <  array_search($childSearchFor, $newParentChildArray.$parentID ) )  {
				
				  		return true;
			       	  }
				
			   else {return true; }  //if either parent as child or child as parent of just parent or just child exist  but not both
				       
				
	
		 } catch( Exception $e ) { return ($e->getLine() . ": " . $e->getMessage() . " : \n" . $e->getTraceAsString()); }  //CATCH END
 
	}  // END FUNCTION
	 	 
	 	 
 
 


?>

 
