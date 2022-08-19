<?php
    $conn = new mysqli("localhost","root","","fia3_website");

    $sport_id = $_GET['sport_id'];
    $city = $_GET['city'];
    $date = $_GET['date'];
    $mentor_id = $_GET['mentor_id'];
    $mentee_id = $_GET['mentee_id'];

    $sql = "SELECT * FROM `book` WHERE `sport_id` = '$sport_id' AND `city` = '$city' AND `date` = '$date' AND `mentor_id` = '$mentor_id' AND `mentee_id` = '$mentee_id'";
    $result = $conn->query($sql);

    $error_message = 'You already booked this session';

    if ($result->num_rows > 0) {
        header("Location: already_book.php?user_id=$mentee_id&sport_id=$sport_id");
    }
    else {
        $insert_sql = "INSERT INTO `book`(`mentee_id`, `mentor_id`, `sport_id`, `city`, `date`) VALUES ('$mentee_id','$mentor_id','$sport_id','$city','$date')";
        // $insert_result = $conn->query($insert_sql);

        // search sport max level
        $sport_max_sql = "SELECT * FROM `sport` WHERE `sport_id` = $sport_id";
        $sport_max_sql_result = $conn->query($sport_max_sql);
        if ($sport_max_sql_result->num_rows > 0) {
            while ($row = $sport_max_sql_result->fetch_assoc()) {
                $sport_max_level = $row["sport_max_level"];
                $sport_book_time = $row["sport_book_time"];
            }
        }

        $sport_book_time+=1;
        echo "sport_max_level: ".$sport_max_level;
        echo "<hr>";
        echo "sport_book_time: ".$sport_book_time;
        echo "<hr>";

        // update sport book time
        $update_sport_book_time = "UPDATE `sport` SET `sport_book_time`='$sport_book_time' WHERE `sport_id` = $sport_id ";
        $update_sport_book_time_result = $conn->query($update_sport_book_time);

        // search mentor and mentee level
        $mentee = "SELECT `sport_level` FROM `skill` WHERE `user_id` = $mentee_id AND `sport_id` = $sport_id";
        $mentee_result = $conn->query($mentee);
        if ($mentee_result->num_rows > 0) {
            while ($row = $mentee_result->fetch_assoc()) {
                $mentee_sport_level = $row["sport_level"];
            }
        }
        $mentee_sport_level+=1;

        echo "mentee_sport_level:= ".$mentee_sport_level;
        echo "<hr>";

        $mentor = "SELECT `sport_level` FROM `skill` WHERE `user_id` = $mentor_id AND `sport_id` = $sport_id";
        $mentor_result = $conn->query($mentor);
        if ($mentor_result->num_rows > 0) {
            while ($row = $mentor_result->fetch_assoc()) {
                $mentor_sport_level = $row["sport_level"];
            }
        }
        $mentor_sport_level+=1;

        echo "mentor_sport_level:= ".$mentor_sport_level;
        echo "<hr>";

        // update mentor and mentee level
        

        // header("Location: info.php?user_id=$mentee_id");
    }
?>