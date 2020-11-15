<?php 
    $con = mysqli_connect('localhost', 'root', '', 'time_table');
    if(!$con) die("cannot connect db server");
    mysqli_select_db($con, "time_table") or die(mysqli_error());
    mysqli_query($con,"set names utf8");
?>
