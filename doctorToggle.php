<?php
include 'DatabaseConfig.php';
if (isset($_POST['Id']) && isset($_POST['approved'])) {//Form was submitted
//  ? $approved = 1 : $approved = 0;
    $machine_id = $_POST['Id'];
    $approved = $_POST['approved'];
    //Update DB
    
    $update = ("UPDATE `doctors` SET `approved` = '$approved' WHERE `Id` = '$machine_id' LIMIT 1;");
    $update = mysqli_query($con, $update);
                  

} else {//Page was loaded
    echo json_encode([$approved = 'approved']);
}
if ($approved) {//approved = 1 (on)
    $data=['success'=>true, 'message'=>'D added successfully.'];
    echo json_encode($data);
} else {
    $data=['success'=>false, 'message'=>'Something went wrong while adding doctor. Please try again.'];
    echo json_encode($data);
}
?>