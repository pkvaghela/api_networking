/*<?php 
    /*
        usage: used to get all the product added into cart  
        how to call : http://localhost/flutter/ws/cart.php?usersid=3
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"total":0}]
        3) [{"error":"no"},{"total":1},{"id":"2","title":"dell laptop","price":"200","quantity":"2",
            "weight":"3500","size":"15 inch","photo":"dell.jpg",
            "detail":"WINDOWS 10 8 GB DDR3 RAM 512 gb ssd hard disk"}] */
        
        input : usersid(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation
    if(isset ($input['usersid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));

    }
    else
    {
    
    $sql =  "select p.id,title,p.price,quantity,weight,size,photo,detail from product p, cart c  where isdeleted=0 and islive=1 and c.productid=p.id and usersid={$input['usersid']}";
    
      
        $product = mysqli_query($link,$sql) or ReturnError(null,__LINE__);


        while($row = mysqli_fetch_assoc($product))
        {
            array_push($response,$row);

        }
        array_unshift($response,array("total"=>mysqli_num_rows($product)));
        array_unshift($response,array("error"=>"no"));

        
    }
    echo json_encode($response);
    ?>
    */
    