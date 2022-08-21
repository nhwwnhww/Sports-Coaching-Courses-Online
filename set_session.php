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

        $search_mentor = "SELECT `city` FROM `user` WHERE `user_id` = $id";
        $search_mentor_result = $conn->query($search_mentor);
        if ($search_mentor_result->num_rows > 0) {
            while ($row = $search_mentor_result->fetch_assoc()) {
                $city = $row["city"];
            }
        }

    ?>
    <h1>set session</h1>
    <form name="submitForm" action="insert_session.php?user_id=<?php echo $id?>&city=<?php echo $city?>" method="POST" enctype="multipart/form-data">
        <select name="sport" id="sport">
        <?php
            $search_sport = "SELECT  `sport_id`,`sport_name` FROM `sport`";
            $search_sport_result = $conn->query($search_sport);
            if ($search_sport_result->num_rows > 0) {
                while ($row = $search_sport_result->fetch_assoc()) {
                    $sport_name = $row["sport_name"];
                    $sport_id = $row["sport_id"];
                    echo "<option value='$sport_id'>$sport_name</option>";
                }
            }
        ?>
        </select>
        <input type="date" name="date">
        <input type="time" name="time">
        <input type="submit" name="submit" value="Set a session"/>
    </form>
    <a href="mentor_info.php?user_id=<?php echo $id?>">cancel</a>
</body>
</html>