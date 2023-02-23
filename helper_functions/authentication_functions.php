<?php
function signUp($username, $password)
{
    //insert the user into the database
    global $con;
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (username, password) VALUES ('$username', '$encrypted_password')";
    $result = mysqli_query($con, $insert_user);
    if ($result) {
        echo json_encode(
            [
                'success' => true,
                'message' => 'User created successfully'
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User creation failed'
            ]
        );
    }
}
function addMerchant($username, $password)
{
    //insert the user into the database
    global $con;
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (username, password, role) VALUES ('$username', '$encrypted_password', 'merchant')";
    $result = mysqli_query($con, $insert_user);
    if ($result) {
        echo json_encode(
            [
                'success' => true,
                'message' => 'Merchant created successfully'
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Merchant creation failed'
            ]
        );
    }
}
function login($password, $databasePassword, $userID, $role)
{
    //insert the user into the database

    if (password_verify($password, $databasePassword)) {
        //create a personal access token 
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        //insert the token into the database
        global $con;
        $insert_token = "INSERT INTO personal_access_token (User_Id, token) VALUES ('$userID', '$token')";
        $result = mysqli_query($con, $insert_token);
        if ($result) {
            echo json_encode(
                [
                    'success' => true,
                    'message' => 'User logged in successfully',
                    'token' => $token,
                    'role'=>$role
                ]
            );
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'User login failed'
                ]
            );
        }
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Password is incorrect'
            ]
        );
    }
}

function checkIdValidUser($token)
{
    global $con;
    if ($token != null) {
        $check_token = "SELECT * FROM personal_access_token WHERE token = '$token'";
        $result = mysqli_query($con, $check_token);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $userID = mysqli_fetch_assoc($result)['User_Id'];
            return $userID;
        } else {
            return null;
        }
    } else {
        return null;
    }
}
function checkIfAdmin($token)
{
    $userId=checkIdValidUser($token);
    if($userId!=null){
        global $con;
        $check_admin = "SELECT * FROM users WHERE User_Id = '$userId'";
        $result = mysqli_query($con, $check_admin);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['role'] == 'merchant') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }else{
        return false;
    }
}


