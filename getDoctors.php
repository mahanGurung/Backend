<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
//get doctors from the database
 $doctors = "SELECT doctors.Id, doctors.name, doctors.image, doctors.description,
    doctors.price, doctors.Merchant_ID as hospital, categories.name as category FROM doctors 
    join hospitals on doctors.Merchant_ID = hospitals.Merchant_ID join categories on doctors.category_id = categories.category_id";
    $result = mysqli_query($con, $doctors);
    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(
            [
                'success' => true,
                'data' => $data,
                'message' => "Products fetched successfully"
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Error fetching product'
            ]
        );
    }

    