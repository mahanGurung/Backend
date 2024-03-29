<?php
 include 'DatabaseConfig.php';
    // Creating MySQL Connection.
    
    if (isset($_POST['User_Id']) && isset($_FILES['image'])) {
        $User_Id = $_POST['User_Id'];
        //getimage
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $image_path = "images/".$image;

        //upload image
        if ($image_size < 5000000) {
            if ($image_ext == "jpg" || $image_ext == "png" || $image_ext == "jpeg") {
                if (move_uploaded_file($image_tmp, $image_path)) {
                    //inserting data into database
                    $sql = "INSERT INTO merchant (User_Id, image) VALUES ('$User_Id', '$image_path')";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        $data=['success'=>true, 'message'=>'Merchant added successfully.'];
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
 ?>