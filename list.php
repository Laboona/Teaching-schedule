<?php 
    require "controllerUserData.php";
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    if($email != false && $password != false){
        $sql = "SELECT * FROM usertable WHERE email = '$email'";
        $run_Sql = mysqli_query($con, $sql);
        if($run_Sql){
            $fetch_info = mysqli_fetch_assoc($run_Sql);
        }
    }else{
        header('Location: login-user.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/Home.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="topnav">
    <a class="active" href="home.php">Home</a>
    <a href="list.php">Add Courses</a>
    <a href="Time_Table.php">My Timetable</a>
        <div class="search-container">
            <a href="logout-user.php">Log out</a>
        </div>
    </div>
<div class="container-fluid">
<div class = "row">
<div class="col-2">
      <p></p>
    </div>
<div class="col-3">
      <p></p>
    </div>
<div class="col-1">
<div class="input-group mb-3">
        <form class="form-inline" action="search_page.php" method="post" enctype="multipart/from-data">
        <div class = "form-group">
            <input type="text" name="c_id" class = "form-control" placeholder="Enter Course id" require> 
            <button type="submit" name="search" class = "btn btn-secondary" >Search</button>

        </div>
        </form>
 </div>
 </div>
 </div>
 </div>

<div class="container">
    <?php include('connection.php');
        $errors = array();
        $sql = "SELECT * FROM schedule;";
        $result = mysqli_query($con, $sql);
    ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>COUSE_ID</th>
                <th>COUSE_NAME</th>
                <th>ROOM</th>
                <th>SECTION</th>
                <th>DATE</th>
                <th>TIME</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)){  
                    $sec_check = $row['sec'];
                    $id_check = $row['id'];
                    $full_check = "SELECT * FROM subject WHERE id = '$id_check' and sec = '$sec_check'";
                    $check_result = mysqli_query($con, $full_check);
                    $check = mysqli_fetch_assoc($check_result);
                    if($check['name_teacher'] === NULL){ ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name_subject'] ?></td>
                <td><?= $row['room'] ?></td>
                <td><?= $row['sec'] ?></td>
                <th><?= $row['day'] ?></th>
                <th><?= $row['time_start'],"-",$row['time_stop'] ?></th>
            </tr>
        <tr>
        <?php }} ?>
        </tbody>
    </table> 
</div>

<div class = "col">
        <form class="form-inline" action="list.php" method="post" enctype="multipart/from-data">
        <br>
        <div class = "form-group">                
            <input type="text" name="c_id" class = "form-control" placeholder="Enter Course id" require> 
            <div class="form-group">
                <label for="sel1"> Section </label>
                <select class="form-control" id="sel1" name="sec">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
            </div>
            <button type="submit" name="select_course" class = "btn btn-secondary" >ADD</button>
            <button type="submit"  class = "btn btn-secondary"  onClick="location.href=location.href" >Refresh</button>
        </div>

        </form>
</div>
        <?php
        if (isset($_POST['select_course'])) {
            $c_id = mysqli_real_escape_string($con, $_POST['c_id']);
            $c_section = mysqli_real_escape_string($con, $_POST['sec']);
            $_POST['teach_name'] = $fetch_info['name'];
            $teach_name = mysqli_real_escape_string($con, $_POST['teach_name']);
        
        
        
            $sql = "SELECT * FROM subject WHERE id = '$c_id' and sec = '$c_section'";
            $result = mysqli_query($con, $sql);
            $resultcheck = mysqli_num_rows($result);
        
            if ($resultcheck > 0) {
                $row = mysqli_fetch_assoc($result);
                if($row['name_teacher'] === NULL) {
                    $update_data = "UPDATE subject SET name_teacher = '$teach_name' WHERE sec = '$c_section' and id = '$c_id'" ;
                    $update_result = mysqli_query($con, $update_data);?>
                    <div class="alert alert-success">
  					    <strong>Success!</strong> ADD course complete.
				    </div>
                <?php }
                else{?>
                    <div class="alert alert-danger">
  					    <strong>Full!</strong> Cann't ADD.
				    </div>
                <?php }
            } else {
                header("location: list.php");
                exit(0);
            }
        }
        ?>

    
</body>
</html>