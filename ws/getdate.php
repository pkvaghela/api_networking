<?php

/*

        usage: used to get current date 
        how to call : http://localhost/flutter/ws/getdate.php 
        output :[{"day":"09","month":"Jul","year":"22"}]
        input : nothing 
*/
//create blank array
$responsive = array();
$day = date("d");
$month = date("M");
$year = date("y");

$date= array("day"=>$day,"month"=>$month,"year" =>$year);
array_push($responsive,$date);
 echo json_encode($responsive);

?>


