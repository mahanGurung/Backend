<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
// Creating MySQL Connection.




if (isset($_POST['username']) && isset($_POST['password']) && isset($_FILES['image']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $image_path = "images/".$image;
    
   
   

    

    //check if the username is already in the database
    $check_name = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $check_name);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo json_encode(
            [
                'success' => false,
                'message' => 'username already exists'
            ]
        );
    } else {
    // $sql1 = "select User_Id from users where username='$username'";
    // $query1 = mysqli_query($con, $sql1);
    // if ($query1) {
    //     $data1 = '';
    //     while ($row1 = mysqli_fetch_assoc($query1)) {
    //         $data1 = $row1['User_Id'];
    //     }
        
    addMerchant($username, $password, $image, $image_tmp, $image_size, $image_ext, $image_path);
    }

} else {
    echo json_encode(
        [
            'message' => 'Please fill all the fields.',
            'success' => false
        ]
    );
}