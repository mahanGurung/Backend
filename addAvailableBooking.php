<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';

// $isAdmin = checkIfMerchant($_POST['token'] ?? null);
// if ($isAdmin) {
    if (isset($_POST['doctor_id']) 
    // && isset($_POST['time']) 
    && isset($_POST['is_daily']) 
    // && isset($_POST['Date'])
    && isset($_POST['show_on_weekends'])
    && isset($_POST['Price']) 
    && isset($_POST['is_visible']) 
    && isset($_POST['merchant_id']) 
    ) {
        $doctor_id = $_POST['doctor_id'];
        $time = date("H:i");
        $is_daily= $_POST['is_daily'];
        $Date = date('Y-m-d');
        $show_on_weekends = $_POST['show_on_weekends'];
        $Price = $_POST['Price'];
        $is_visible = $_POST['is_visible'];
        $merchant_id = $_POST['merchant_id'];
         //getimage
        
    

      //upload image
      
                  $sql = "INSERT INTO availables_bookings (doctor_id, time, is_daily, Date, show_on_weekends, Price, is_visible, merchant_id) VALUES ('$doctor_id', '$time', '$is_daily','$Date', '$show_on_weekends', '$Price', '$is_visible', '$merchant_id')";
                  $query = mysqli_query($con, $sql);
                  if ($query) {
                    $data=['success'=>true, 'message'=>'Doctor added successfully'];
                    echo json_encode($data);
                    //  getProducts("Doctor added successfully.");
                  } else {
                      $data=['success'=>false, 'message'=>'Something went wrong.'];
                      echo json_encode($data);
                  }
             

      
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Please fill all the fields.'
            ]
        );
    }

// } else {
//     echo json_encode(
//         [
//             'success' => false,
//             'message' => 'Access denied'
//         ]
        
//     );
// }

