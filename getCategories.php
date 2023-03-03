<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
//get categories from the database
 if(!$con){
    echo json_encode(
        [
            'success' => false,
            'message' => 'Error fetching categories'
        ]
    );
 }

 $list = array();
 $categories = "SELECT category_id, name FROM categories";
 $result = mysqli_query($con, $categories);
//  $result = $con->query("SELECT category_id, name FROM categories");
if ($result) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        $list[]  = $row;
    }

    echo json_encode($list);
 }