<?php
 //Define your Server host name here.
 $HostName = "localhost:3306";
 
 //Define your MySQL Database Name here.
 $DatabaseName = "hajur_ko_doctor";
 
 //Define your Database User Name here.
 $HostUser = "root";
 
 //Define your Database Password here.
 $HostPass = ""; 
 $con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
