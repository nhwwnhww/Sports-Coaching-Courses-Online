<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Your session</h1>
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
    <h1>mentee booked</h1>
    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $sql = "SELECT * FROM `book` WHERE `mentor_id` = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mentee_id = $row["mentee_id"];
                $mentor_id = $row["mentor_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $feedback = $row["feedback"];

                echo "<hr>";
                echo "<h3>mentee_id</h3>";
                echo $mentee_id;
                echo "<br>";
                echo "<h3>mentor_id</h3>";
                echo $mentor_id;
                echo "<br>";
                echo "<h3>sport_id</h3>";
                echo $sport_id;
                echo "<br>";
                echo $city;
                echo "<br>";
                echo $date;
                echo "<br>";
                echo $feedback;
                echo "<hr>";
            }
        }
    ?>
    <a href="set_session.php?user_id=<?php echo $id?>">set a session</a>
    <br>
    <a href="info.php?user_id=<?php echo $id?>">back</a>
</body>
</html>