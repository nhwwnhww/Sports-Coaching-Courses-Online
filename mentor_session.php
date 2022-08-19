<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $user_id = $_GET['user_id'];
        $sport_id = $_GET['sport_id'];

        $sql = "SELECT `sport_level` FROM `skill` WHERE `user_id` = $user_id AND `sport_id` = $sport_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_level = $row["sport_level"];
                echo $sport_level;
            }
        }
        else {
            $insert_sql = "INSERT INTO `skill`(`user_id`, `sport_id`, `sport_level`) VALUES ('$user_id','$sport_id','1')";
            $insert_result = $conn->query($insert_sql);
            header("Location: mentor_session.php?user_id=$user_id&sport_id=$sport_id");
        }
    ?>
</body>
</html>