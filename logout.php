<?php
     include 'DatabaseConfig.php';
     // Creating MySQL Connection.
     $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

     if( isset($_POST['token']) ) //check is token is sent by the user
    {
        $access_token = $_POST['token'];

        if( isset($_POST['User_Id']) )
        {
            $userid = $_POST['User_Id'];
            //logging out user for particular device...
            $query = "DELETE FROM personal_access_tokens WHERE User_Id='$userid'";

        }else{

            //logging out user for all devices...
            $query = "DELETE FROM personal_access_tokens WHERE token='$access_token'";

        }
        $query = mysqli_query($con, $query);
        if ($query) {
            //after the query is sucessfully executed! (logged out)
            $data=[
                'success'=>true,
                'message'=>'Logout Successful'
            ];
            echo json_encode($data);
    
        } else {
    
            $data=['success'=>false, 'message'=>'Logout failed'];
    
             echo json_encode($data);
        }
        

    }else{

        //when token is not sent by the user
        $data=[
            'success'=>false,
            'message'=>'token is required'
        ];
        echo json_encode($data);
    }
    


?>