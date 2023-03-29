<?php
 include 'DatabaseConfig.php';
    // Creating MySQL Connection.
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    try {
       
    if (isset($_POST['category_id']) && isset($_POST['name'])) {
        $name=$_POST['name'];
        $id=$_POST['category_id'];
        //getimage
        if(isset($_FILES['image'])){
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
                        $sql = "UPDATE categories SET name='$name',image='$image_path' WHERE category_id='$id'";
                        $query = mysqli_query($con, $sql);
                        if ($query) {
                            $data=['success'=>true, 'message'=>'Category updated successfully.'];
                            echo json_encode($data);
                        } else {
                            $data=['success'=>false, 'message'=>'Something went wrong.1'];
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
            $sql = "UPDATE categories SET name='$name' WHERE category_id='$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $data=['success'=>true, 'message'=>'Category updated successfully.'];
                echo json_encode($data);
            } else {
                $data=['success'=>false, 'message'=>'Something went wrong.'];
                echo json_encode($data);
            }

        }

    }else{
        $data=['success'=>false, 'message'=>'Id,Category name and image is required.'];
        echo json_encode($data);
    }
    } catch (\Throwable $th) {
        echo $th;
    }
 ?>