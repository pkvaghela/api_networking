<?php 
    /*
        usage: used to register user 
        how to call : http://localhost/flutter/ws/register.php?email=parthvaghela254@gmail.com&password=555555&mobile=1234512345

         output: [{"error":"no"},{"success":"yes"},{"message":"registered successfully"}]
                 [{"error":"input is missing"}] 
                [{"error":"no"},{"success":"no"},{"message":"email or mobile is already register with us"}]


        input : email,password,mobile(require)
        */
        require_once("../inc/connection.php");
        $response = array();
        //input validation
        if(isset($input['email'],$input['password'],$input['mobile'])==false)
        {
            array_push($response,array("error"=>"input is missing"));
        }
        else
        {
              //if all input are given 
            $sql = "select id from users where email= '{$input['email']}'  or mobile = '{$input['mobile']}'";

            
          





            $users = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
            $count =mysqli_num_rows($users);

            if($count>=1)
            {

                array_push($response,array("success"=>"no"));
                array_push($response,array("message"=>"email or mobile is allready register with us "));


            }
            else
            {
  //email and mobile not found 

  $input['password'] = HashPassword($input['password']);
  $sql = "insert into users (email,password,mobile) values ('{$input['email']}','{$input['password']}','{$input['mobile']}')";
   mysqli_query($link,$sql) or ReturnError(null,__LINE__);
   array_push($response,array("success"=>"yes"));
   array_push($response,array("message"=>"registered successfully "));


            }

            array_unshift($response,array("error"=>"no"));
        }
        echo json_encode($response);
        ?>