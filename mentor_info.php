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

        $id = $_GET['user_id'];

        $sql = "SELECT * FROM `mentor_session` WHERE `mentor_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $session_id = $row["session_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];

                echo "<hr>";
                echo $session_id;
                echo "<br>";
                echo $sport_id;
                echo "<br>";
                echo $city;
                echo "<br>";
                echo $date;
                echo "<hr>";
            }
        }
    ?>
    <a href="set_session.php?user_id=<?php echo $id?>">set a session</a>
</body>
</html>