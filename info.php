<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>personal info</h1>
    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $id = $_GET['user_id'];

        $sql = "SELECT * FROM `user` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $username = $row["username"];
                $password = $row["password"];
                $img_url = $row["img_url"];
                $city = $row["city"];
                $email = $row["email"];
                $age = $row["age"];
                $phone = $row["phone"];

                echo $user_id;
                echo '<br>';
                echo $username;
                echo '<br>';
                echo $password;
                echo '<br>';
                echo $img_url;
                echo '<br>';
                echo $city;
                echo '<br>';
                echo $email;
                echo '<br>';
                echo $age;
                echo '<br>';
                echo $phone;

            }
        }
    ?>
<br>
<img src="<?php echo $img_url?>" alt="" width="75px">
<br>
<a href="update_info.php?user_id=<?php echo $id?>">update</a>
    <hr>

        <h1>your sport level</h1>

        <?php

        $sql = "SELECT * FROM `skill` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_level = $row["sport_level"];

                echo '<hr>';
                echo 'sport_id: ';
                echo $sport_id;
                echo '<br>';
                echo 'sport_level: ';
                echo $sport_level;
                echo '<hr>';
            }
        }
    ?>

    <hr>

<h1>Your book</h1>

<?php

        $sql = "SELECT * FROM `book` WHERE `mentee_id` = $user_id";
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

    <a href="display_sport.php?user_id=<?php echo $id?>">book a sport</a>
    <hr>
    <a href="mentor_info.php?user_id=<?php echo $id?>">become a mentor</a>
    <hr>
    <a href="index.php">log out</a>
</body>
</html>