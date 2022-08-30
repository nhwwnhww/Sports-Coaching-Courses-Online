<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php 
    $conn = new mysqli("localhost","root","","fia3_website");

    $id = $_GET['user_id'];
        // get sport info model

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sport_list = array();
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_max_level = $row["sport_max_level"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];

                // $temp_array = array($sport_id=>
                //     'sport_name';
                array_push($sport_list, $temp_array);
            }
        }
    ?>
</head>
<body>
    <h1>Your session</h1>
    <?php
        
        $sql = "SELECT * FROM `user` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $city = $row["city"];
                if ($city == ""){
                    header("Location: info.php?user_id=$id");
                }
            }
        }

        $sql = "SELECT * FROM `mentor_session` WHERE `mentor_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped table-hover'>";

            while ($row = $result->fetch_assoc()) {
                $session_id = $row["session_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];

                echo "<tr>
                    <th>Session id</th>
                    <th>sport name</th>
                    <th></th>
                    <th></th>
                </tr>";

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
            echo "</table>";
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