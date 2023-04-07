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
     
     
    && isset($_POST['merchant_id']) 
    && isset($_POST['quantity'])
    ) {
        $doctor_id = $_POST['doctor_id'];
        $is_daily= $_POST['is_daily'];
        $Date = date('Y-m-d');
        $show_on_weekends = $_POST['show_on_weekends'];
        $quantity = $_POST['quantity'];
    
        
        $merchant_id = $_POST['merchant_id'];
         //getimage
        
         $check_name = "SELECT * FROM availables_bookings WHERE doctor_id = '$doctor_id' AND Date = '$Date'";
         $result = mysqli_query($con, $check_name);
         $count = mysqli_num_rows($result);
         if ($count > 0) {
             echo json_encode(
                 [
                     'success' => false,
                     'message' => 'Booking already exits'
                 ]
                 ); 
            }else {

                //upload image
                
                          //   $sql = "INSERT INTO availables_bookings (doctor_id, is_daily, Date, show_on_weekends, quantity, merchant_id) VALUES ('$doctor_id', '$is_daily','$Date', '$show_on_weekends', '$quantity','$merchant_id')";
                          //   $query = mysqli_query($con, $sql);
                          //   if ($query) {
                          //     $data=['success'=>true, 'message'=>'Doctor added successfully'];
                          //     echo json_encode($data);
                          //     //  getProducts("Doctor added successfully.");
                          //   } else {
                          //       $data=['success'=>false, 'message'=>'Something went wrong.'];
                          //       echo json_encode($data);
                          //   }
                       
                          // }
                          addbooking($doctor_id, $is_daily, $Date, $show_on_weekends,$quantity,$merchant_id);
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

