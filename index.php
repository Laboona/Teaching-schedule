<?php include('connection.php'); ?>
<?php
    include "Line_model.php";

    $line = new Line_Notify();

    $line->setToken('7Sop4Rc7xAFZwoLoltZqdGhDKjysYOaxWbXKJQeOwip');

    $line->setMsg('แจ้งเตือน');
    $line->addMsg('*********************');
    $check30 = "SELECT count(id) as id1 FROM schedule Where TIMESTAMPDIFF(MINUTE, NOW(), time_start)";
    $res1 = mysqli_query($con, $check30);
    $row1 = mysqli_fetch_assoc($res1);
    if ($row1['id1']>0){
        $sql2 = "SELECT id FROM schedule";
        $res2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $sql3 = "SELECT name_subject FROM schedule";
        $res3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($res3);
        $line->addMsg('คุณมีสอนในอีก 30 นาที ในรายวิชา '.implode(" ",$row2)." ".implode(" ", $row3));
    }
    $line->addMsg('*********************');
    $line->setSPId(1);
    $line->setSId(2);
    if($line->sendNotify()){
        echo 'Sent';
    } else {
        echo '<pre>';
        print_r($line->getError());
        echo '</pre>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="home.php">
        <button type="submit" name="back" class = "btn btn-secondary" >back</button>
    </a>
</body>
</html>

