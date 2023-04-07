<?php
include 'DatabaseConfig.php';
if (isset($_POST['doctor_id']) && isset($_POST['is_visible'])) {//Form was submitted
//  ? $approved = 1 : $approved = 0;
    $machine_id = $_POST['doctor_id'];
    $approved = $_POST['is_visible'];
    //Update DB
    
    $update = ("UPDATE `availables_bookings` SET `is_visible` = '$approved' WHERE `doctor_id` = '$machine_id' LIMIT 1;");
    $update = mysqli_query($con, $update);
                  

} else {//Page was loaded
    echo json_encode([$approved = 'is_visible']);
}
if ($approved) {//approved = 1 (on)
    $data=['success'=>true, 'message'=>'D added successfully.'];
    echo json_encode($data);
} else {
    $data=['success'=>false, 'message'=>'toggle  again.'];
    echo json_encode($data);
}
?>