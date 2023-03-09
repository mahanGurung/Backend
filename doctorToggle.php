<?php
if (isset($_POST['Id'])) {//Form was submitted
    (isset($_POST['approved'])) ? $approved = 1 : $approved = 0;
    $machine_id = $_POST['Id'];
    //Update DB
    $db = new PDO('mysql:host=localhost;dbname=hajur_ko_doctor;charset=utf8mb4', 'root', '');
    $update = $db->prepare("UPDATE `doctors` SET `approved` = ? WHERE `Id` = ? LIMIT 1;");
    $update->execute([$approved, $machine_id]);
} else {//Page was loaded
    echo json_encode([$approved = 'approved']);
}
if ($approved) {//approved = 1 (on)
    $data=['success'=>true, 'message'=>'Category added successfully.'];
    echo json_encode($data);
} else {
    $data=['success'=>false, 'message'=>'Something went wrong while adding category. Please try again.'];
    echo json_encode($data);
}
?>