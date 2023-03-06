<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
//get merchants from the database
 if(!$con){
    echo json_encode(
        [
            'success' => false,
            'message' => 'Error fetching Merchant'
        ]
    );
 }

 $list = array();
 $merchant = "SELECT * FROM users where role='merchant'";
 $result = mysqli_query($con, $merchant);

if ($result) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        $list[]  = $row;
    }
//  if($result){
//     while($row = $result->fetch_assoc()){
//         $list = $row;
//     }
    echo json_encode($list);
 }