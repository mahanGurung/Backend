<!-- <?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
include 'addAvailableBooking.php';
//get categories from the database
global $doctor_Id;
 $categories = "SELECT Merchant_ID, name FROM doctors WHERE Id = '$doctor_Id'";
    $result = mysqli_query($con, $categories);
    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(
            [
                'success' => true,
                'data' => $data,
                'message' => "Mercahnts fetched successfully"
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Error fetching Merchants'
            ]
        );
    }



// include 'DatabaseConfig.php';
// include 'helper_functions/authentication_functions.php';
// //get sql from the database
//  $sql = "select User_Id from users where username='Mahan'";
//     $query = mysqli_query($con, $sql);
//     if ($query) {
//         $data = '';
//         while ($row = mysqli_fetch_assoc($query)) {
//            $data = $row['User_Id'];
//         }
//         echo json_encode(
//             [
//                 'success' => true,
//                 'data' => $data,
//                 'message' => "Mercahnts fetched successfully"
//             ]
//         );
//     } else {
//         echo json_encode(
//             [
//                 'success' => false,
//                 'message' => 'Error fetching Merchants'
//             ]
//         );
//     } -->