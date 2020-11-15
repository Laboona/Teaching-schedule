<?php require_once "controllerUserData.php"; ?>
<?php 
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
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="css/Home.css">
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
    <h1>Welcome <?php echo $fetch_info['name'] ?></h1>
    <a href="index.php">
        <button type="submit" name="remind" class = "btn btn-secondary" >Reminder</button>
    </a>
    
</body>
</html>

