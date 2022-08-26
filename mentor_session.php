<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>display sport level</h1>
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

        <h1>mentee Location</h1>

    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $search_mentee_city_sql = "SELECT `city` FROM `user` WHERE `user_id` = '$user_id'";
        $search_mentee_city_sql_result = $conn->query($search_mentee_city_sql);
        if ($search_mentee_city_sql_result->num_rows > 0) {
            while ($row = $search_mentee_city_sql_result->fetch_assoc()) {
                $mentee_city = $row["city"];
            }
        }
        echo "Your location is at ";
        echo $mentee_city;
    ?>

    <h1>display available session</h1>
    <?php
        
        $sql = "SELECT * FROM `mentor_session` WHERE `city` = '$mentee_city' AND `sport_id` = $sport_id AND NOT `mentor_id` = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $session_id = $row["session_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $mentor_id = $row["mentor_id"];

                echo "<hr>";
                echo $session_id;
                echo "<br>";
                echo $sport_id;
                echo "<br>";
                echo $city;
                echo "<br>";
                echo $date;
                echo "<br>";
                echo "<a href='book_session.php?sport_id=$sport_id&city=$city&date=$date&mentor_id=$mentor_id&mentee_id=$user_id'>book</a>";
                echo "<hr>";

            }
        }
    ?>
    <h1>other session away your location</h1>
    <?php
        
        $sql = "SELECT * FROM `mentor_session` WHERE `sport_id` = $sport_id AND NOT `city` = '$mentee_city' AND NOT `mentor_id` = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $session_id = $row["session_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $mentor_id = $row["mentor_id"];

                echo "<hr>";
                echo $session_id;
                echo "<br>";
                echo $sport_id;
                echo "<br>";
                echo $city;
                echo "<br>";
                echo $date;
                echo "<br>";
                echo "<a href='book_session.php?sport_id=$sport_id&city=$city&date=$date&mentor_id=$mentor_id&mentee_id=$user_id&sport_id=$sport_id'>book</a>";
                echo "<hr>";
            }
        }
    ?>
    <a href="display_sport.php?user_id=<?php echo $user_id?>">back</a>
</body>
</html>