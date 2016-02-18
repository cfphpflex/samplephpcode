<?php
        
/* Purpose: Create Stair case */
$n = 6; //input
$stairs = array(); //array structure to hold stairs data
print_r( (myStairs($n))); // call function
function myStairs ( $n ) {
    for ( $i=1; $i<= $n; $i++) { //loop for all stair steps
        // create step
        $stairs[$i] =     str_repeat("  ", $n-$i)  . str_repeat("#", $i)  ;
    }
    return $stairs;
}

