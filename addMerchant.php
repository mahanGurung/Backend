<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
// Creating MySQL Connection.


if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

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
        addMerchant($username, $password);
    }
} else {
    echo json_encode(
        [
            'message' => 'Please fill all the fields.',
            'success' => false
        ]
    );
}


