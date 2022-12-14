<?php 
    /*
        usage: used to change as user's password
        how to call : http://localhost/flutter/ws/change_password.php?id=3&password=123123&newpassword=112233
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"no"},{"message":"invalid change password attempt"}]
        [{"error":"no"},{"success":"yes"},{"message":"password changed"}]
        input : id,password,newpassword(required) 
    */

    require_once("../inc/connection.php");
    $response = array();
    //input validation
    if(isset($input['id'],$input['password'],$input['newpassword'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }

    else
    {
         // //if all input are given 

         $sql = "select password from users where id = '{$input['id']}'";
         $users= mysqli_query($link,$sql) or  ReturnError(null_LINE_);
         $count =  mysqli_num_rows($users);

         if($count == 0)
         {
        array_push($response,array("success"=>"no"));
        array_push($response,array("message"=>"invalid change password attempt"));
         }
         else
         {

              $row = mysqli_fetch_assoc($users);
               if(MatchPassword($row['password'],$input['password'])==false)
{
         array_push($response,array("success"=>"no"));
         array_push($response,array("message"=>"invalid password"));

         }
         else

         {    

            //id and password both are matching

            $input['newpassword'] = HashPassword($input['newpassword']);
            $sql = "update  users set password = '' where id= {$input['id']}";
            mysqli_query($link,$sql) or ReturnError(null,__LINE__);

            array_push($response,array("success"=>"yes"));
            array_push($response,array("message"=>" password change"));



         }
        }
        array_unshift($response,array("error"=>"no"));


    }
    echo json_encode($response);
    ?>