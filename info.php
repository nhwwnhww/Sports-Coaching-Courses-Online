<!-- php debug -->
<?php 
    function debug_to_console($data) {
        echo "<script>console.log('Debug log: " . json_encode($data) . "' );</script>";
    }
?>

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

                $temp_array = array($sport_id=>array(
                    'sport_name'=>$sport_name,
                    'img_url'=>$img_url,
                    'sport_describe'=>$sport_describe,
                    'sport_max_level'=>$sport_max_level,
                    'sport_book_time'=>$sport_book_time,
                    'sport_max_participate'=>$sport_max_participate));
                array_push($sport_list, $temp_array);
            }
        }

        // $find = array_column($sport_list, '1');

        // $bar = "-----------";

        // debug_to_console($sport_list);
        // debug_to_console($bar);
        // debug_to_console($find);
        // debug_to_console($bar);
        // debug_to_console($find[0]['sport_name']);


        $sql = "SELECT * FROM `skill` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
                <th>sport_id</th>
                <th>sport_name</th>
                <th>level</th>
            </tr>";
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_level = $row["sport_level"];

                $find = array_column($sport_list, $sport_id);

                echo '<tr>';
                echo "<td>".$sport_id."</td>";
                echo "<td>".$find[0]['sport_name']."</td>";
                echo "<td>".$sport_level."</td>";
                echo '<tr>';
            }
            echo "</table>";
        }
    ?>

    <hr>

<h1>Your book</h1>

<?php

        $sql = "SELECT * FROM `book` WHERE `mentee_id` = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
             echo "<table>
            <tr>
                <th>mentee_id</th>
                <th>mentor_id</th>
                <th>sport_id</th>
                <th>city</th>
                <th>date</th>
                <th>feedback</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                $mentee_id = $row["mentee_id"];
                $mentor_id = $row["mentor_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $feedback = $row["feedback"];

                echo "<tr>";
                echo "<td>".$mentee_id."</td>";
                echo "<td>".$mentor_id."</td>";
                echo "<td>".$sport_id."</td>";
                echo "<td>".$city."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$feedback."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>

    <a href="display_sport.php?user_id=<?php echo $id?>">book a sport</a>
    <hr>
    <a href="mentor_info.php?user_id=<?php echo $id?>">become a mentor</a>
    <hr>
    <a href="index.php">log out</a>
    <hr>
    <a href="./input_game_info.php?user_id=<?php echo $id?>">Find a friendly game</a>
</body>
</html>