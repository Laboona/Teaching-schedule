<?php 
require "connection.php";
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<title> ตารางสอน อาจารย์<?php echo $_SESSION['ses_username'];?> </title>
	<link rel="stylesheet" href="css/Home.css">
	<link rel="stylesheet" href="css/list.css">
	<meta name="Generator" content="EditPlus">
	<meta name="Author" content="Unidentifier">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<style type="text/css">
			td { width:170px; border:3px solid white; background:white; height:3em; vertical-align:top;text-align:center;}
			tr:first-child td{ border:3px solid black; background:LightSlateGray;color:white; height:1.2em; vertical-align:baseline;text-align:center;}
			tr td:first-child {border:3px solid black; background:LightSlateGray;color:white; height:1.2em; vertical-align:middle;width:110px;}
			tr:nth-child(even){ border:3px solid black; background:white;color:black; height:1.2em; vertical-align:baseline;text-align:center;}
			td:nth-child(odd){ border:3px solid black; background:white;color:black; height:1.2em; vertical-align:baseline;text-align:center;}
			.smallCaps{font-size:0.8em;text-align:center;vertical-align:middle;}
			.title{display:block; width:auto; text-align:center; padding:1.5em; font-size:1.2em; background-color: #8A2BE2;border:3px solid black;color:white}
	</style>
	</head>

	<body>
	<div class="topnav">
    <a class="active" href="home.php">Home</a>
    <a href="list.php">Add Courses</a>
    <a href="Time_Table.php">My Time Table</a>
        <div class="search-container">
            <a href="logout-user.php">Log out</a>
        </div>
    </div>
	<div class="title">ตารางสอน อาจารย์ <?php echo $fetch_info['name'];?> </div>
	<table class="table table-bordered">
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	</table>
	<script>
	var timing = ["","08:00 - 09:30","09:30 - 11:00","11:00 - 12:30","13:00 - 14:30","14:30 - 16:00","16:00 - 17:30"];
	var day = ["","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์"];
	var rows = 0;
	var cols = 0;
	$("table tr:first-child td").each(function(index){
		if(index>0)
		$(this).text(timing[cols]);
			cols++;
	});
	$("table tr td:first-child").each(function(index){
		if(index>0)
		$(this).text(day[rows]);
			rows++;
	});

</script>



<script>
<?php

$timing = array("","08:00 - 09:30","09:30 - 11:00","11:00 - 12:30","13:00 - 14:30","14:30 - 16:00","16:00 - 17:30");
$timing = array_flip($timing);
$day = array("","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์");
$day = array_flip($day);
$_SESSION['ses_username'] = $fetch_info['name'];
$sql = "select * from subject where `name_teacher`='{$_SESSION['ses_username']}' ";

$res = mysqli_query($con, $sql) or die(mysqli_error());
while($data = mysqli_fetch_assoc($res)){
	$sql2 = "select * from schedule where name_subject = '{$data["name_subject"]}' ";
	$res2 = mysqli_query($con,$sql2) or die(mysqli_error());
	while($data2 = mysqli_fetch_assoc($res2)){
			$timestart=substr($data2["time_start"],0,-3);
		$timestop=substr($data2["time_stop"],0,-3);
		$time = "$timestart - $timestop";
		echo "\$(\"tr:nth-child(".($day[$data2["day"]]+1).") td:nth-child(".($timing[$time]+1).")\").append('<b>{$data2["id"]}<br/><b>{$data2["name_subject"]}<br/><b>{$data2["room"]}</b><br>{$data2["sec"]}</br>').addClass('smallCaps');\n";
	}
	
}
?>
</script>
	<div class = "col">
        <form class="form-inline" action="Time_Table.php" method="post" enctype="multipart/from-data">
        <div class = "form-group">
            <input type="text" name="c_id" class = "form-control" placeholder="Enter Course id" require> 
            <div class="form-group">
                <label for="sel1">Section</label>
                <select class="form-control" id="sel1" name="sec">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
            </div>
            <button type="submit" name="delete_course" class = "btn btn-secondary" >Delete</button>
            <button type="submit"  class = "btn btn-secondary"  onClick="location.href=location.href" >Refresh</button>
        </div>

        </form>
       
    </div>
        <?php
        $conn = mysqli_connect("localhost","root","","time_table");
        if (isset($_POST['delete_course'])) {
            $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
            $c_section = mysqli_real_escape_string($conn, $_POST['sec']);
        
        
        
            $sql = "SELECT * FROM subject WHERE id = '$c_id' and sec = '$c_section'";
            $result = mysqli_query($conn, $sql);
            $resultcheck = mysqli_num_rows($result);
        
            if ($resultcheck > 0) {
                $row = mysqli_fetch_assoc($result);
                $update_data = "UPDATE subject SET name_teacher = NULL WHERE sec = '$c_section' and id = '$c_id'" ;
                $update_result = mysqli_query($conn, $update_data); ?>
				<div class="alert alert-success">
  					<strong>Success!</strong> Remove course complete.
				</div>
    	<?php } else {
                header("location: Time_Table.php");
                exit(0);
            }
        }
        ?>
</body>
</html>