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
        $sport_id = $_GET['sport_id'];

        if (isset($_POST['time']) && isset($_POST['city'])){
            $time = $_POST['time'];
            $city = $_POST['city'];
            
            echo $time;
            echo $city;

            $sql = "SELECT `sport_level` FROM `skill` WHERE `user_id`= $id AND `sport_id` = $sport_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sport_level = $row["sport_level"];
                }
            };

            $sql = "SELECT * FROM `game` WHERE `sport_id`=$sport_id AND `city`='$city' AND `time`='$time'";
            $result = $conn->query($sql);
            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO `game`(`sport_id`, `sport_average_level`,`participate_number`, `city`, `time`) VALUES ('$sport_id','$sport_level',1,'$city','$time')";
                $result = $conn->query($sql);

                $sql = "select * from `game` order by `game_id` desc limit 1;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $game_id = $row["game_id"];
                    }
                }
                $sql = "INSERT INTO `participate`(`user_id`, `sport_id`, `sport_level`, `game_id`) VALUES ('$id','$sport_id','$sport_level','$game_id')";
                $result = $conn->query($sql);

                header("Location: join_game_success.php?user_id=$id");
            }
            else {
                echo "game already set please set another one";
            }
        }

        $sql = "SELECT `sport_name` FROM `sport` WHERE `sport_id` = $sport_id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_name = $row["sport_name"];
            }
        }
        $sql = "SELECT `city` FROM `user` WHERE `user_id` = $id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $city = $row["city"];
            }
        }

    ?>
    <form name="submitForm" action="Create_game.php?user_id=<?php echo $id?>&sport_id=<?php echo $sport_id?>" method="POST">
        <h1>Your are creating a <?php echo $sport_name?> game</h1>
        <br>
        <label for="">Select a time for game</label>
        <input type="datetime-local" name="time">
        <br>
        <label for="">input a location for game</label>
        <input type="text" name="city" value="<?php echo $city;?>">
        <br>
        <input type="submit" name="submit" value="submit"/>
    </form>
    <a href="Find_or_create.php?user_id=<?php echo $id?>">back</a>
</body>
</html>