<?php
include 'DatabaseConfig.php';
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
function addMerchant($username, $password, $image, $image_tmp, $image_size, $image_ext, $image_path)
{
    //insert the user into the database
    global $con;
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (username, password, role) VALUES ('$username', '$encrypted_password', 'merchant')";
    $result = mysqli_query($con, $insert_user);
    if ($result) {
        
        
        $sql1 = "select User_Id from users where username='$username'";
        $query1 = mysqli_query($con, $sql1);
        if ($query1) {
            $data1 = '';
            while ($row1 = mysqli_fetch_assoc($query1)) {
                $data1 = $row1['User_Id'];
            }
        
        
        // $sql = "INSERT INTO merchant (user_id, image) VALUES ('$data1', '$IDATA')";
        //                 $query = mysqli_query($con, $sql);
        //                 if ($query) {
        //                     $data=['success'=>true, 'message'=>'Merchant added successfully.'];
        //                     echo json_encode($data);
        //                 } else {
        //                     $data=['success'=>false, 'message'=>'Something went wrong while adding merchant 1. Please try again.'];
        //                     echo json_encode($data);
        //                 }
            
        
            
            //getimage
            
            
            //upload image
            if ($image_size < 5000000) {
                if ($image_ext == "jpg" || $image_ext == "png" || $image_ext == "jpeg") {
                    if (move_uploaded_file($image_tmp, $image_path)) {
                        //inserting data into database
                        $sql = "INSERT INTO merchant (user_id, image) VALUES ('$data1', '$image_path')";
                        $query = mysqli_query($con, $sql);
                        if ($query) {
                            $data=['success'=>true, 'message'=>'Merchant created and added successfully.'];
                            echo json_encode($data);
                        } else {
                            $data=['success'=>false, 'message'=>'Something went wrong while adding merchant 1. Please try again.'];
                            echo json_encode($data);
                        }
                    } else {
                        $data=['success'=>false, 'message'=>'Something went wrong.'];
                        echo json_encode($data);
                    }
                } else {
                    $data=['success'=>false, 'message'=>'Image must be jpg, png or jpeg.'];
                    echo json_encode($data);
                }
            } else {
                $data=['success'=>false, 'message'=>'Image size must be less than 5MB.'];
                echo json_encode($data);
            }
    
        }else{
            $data=['success'=>false, 'message'=>'Merchant User_Id and image is required.'];
            echo json_encode($data);
        }
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
            if ($user['role'] == 'admin') {
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

function checkIfMerchant($token)
{
    $userId=checkIdValidUser($token);
    if($userId!=null){
        global $con;
        $check_merchant = "SELECT * FROM users WHERE User_Id = '$userId'";
        $result = mysqli_query($con, $check_merchant);
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

function addbooking($doctor_id, $is_daily, $Date, $show_on_weekends, $quantity,$merchant_id)
{
    global $con;
    $sql = "INSERT INTO availables_bookings (doctor_id, is_daily, Date, show_on_weekends, quantity, merchant_id) VALUES ('$doctor_id', '$is_daily','$Date', '$show_on_weekends', '$quantity','$merchant_id')";
    $query = mysqli_query($con, $sql);
    if ($query) {
      $data=['success'=>true, 'message'=>'Doctor added successfully'];
      echo json_encode($data);
      //  getProducts("Doctor added successfully.");
    } else {
        $data=['success'=>false, 'message'=>'Something went wrong.'];
        echo json_encode($data);
    }

  
}


