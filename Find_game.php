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
<?php
        $conn = new mysqli("localhost","root","","fia3_website");
        $id = $_GET['user_id'];
        $sport_id = $_GET['sport_id'];

        $sql = "SELECT * FROM `sport` WHERE `sport_id` = $sport_id";
        $result = $conn->query($sql);

        // sport array
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

        // user sport level
        $sql = "SELECT `sport_level` FROM `skill` WHERE `user_id` = $id AND `sport_id` = $sport_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_level = $row["sport_level"];
            }
        } 
        else{
            $sport_level = 1;
        }

        // debug_to_console($sport_list);

        if (isset($_GET['game_id'])){
            $game_id = $_GET['game_id'];
            $origin_game_id = $_GET['game_id'];
            // debug_to_console($game_id); 

            $sql = "SELECT * FROM `participate` WHERE `user_id` = $id AND `sport_id` = $sport_id AND `game_id` = $origin_game_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                header("Location: Already_in_game.php?user_id=$id&sport_id=$sport_id");
            }
            else {
                // check sport max participate
            debug_to_console("sport_max_participate ".$sport_max_participate);

            // compare to game participate number
            $sql = "SELECT `participate_number` FROM `game` WHERE `game_id` = $game_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $participate_number = $row["participate_number"];
                }
            }
            $participate_number += 1;
            debug_to_console("participate_number ".$participate_number);


            // if hit max number jump to other page

                if ($participate_number > $sport_max_participate){
                    header("Location: Game_full.php?user_id=$id&sport_id=$sport_id");
                }
                else{
                    // insert participate (user_id sport_id sport_level game_id)

                    $sql = "INSERT INTO `participate`(`user_id`, `sport_id`, `sport_level`, `game_id`) VALUES ('$id','$sport_id','$sport_level','$origin_game_id')";
                    $result = $conn->query($sql);

                    // find all participate in this game, calculate the average level
                    $sql = "SELECT `sport_level` FROM `participate` WHERE `game_id` = $origin_game_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $count=0;
                        $total_level=0;
                        while ($row = $result->fetch_assoc()) {
                            $sport_level = $row["sport_level"];
                            $count += 1;
                            $total_level += $sport_level;
                        }
                        $average_level = $total_level / $count;
                    }
                    debug_to_console("average_level ".$average_level);


                    // update game info (sport_average_level ,participate_number += 1)
                    $sql = "UPDATE `game` SET `sport_average_level`='$average_level',`participate_number`='$participate_number' WHERE `game_id` = $origin_game_id";
                    $result = $conn->query($sql);
                    header("Location: join_game_success.php?user_id=$id");
                }
            }

        }

        // debug_to_console($sport_level);

        if ($sport_level == 1){
            $sql = "SELECT * FROM `game` WHERE `sport_id` = $sport_id AND `sport_average_level` <= 2";
            $result = $conn->query($sql);
        }
        else {
            $sport_level_max = $sport_level + 1;
            $sport_level_min = $sport_level - 1;
            $sql = "SELECT * FROM `game` WHERE `sport_id` = $sport_id AND `sport_average_level` <= $sport_level_max AND `sport_average_level` >= $sport_level_min";
            $result = $conn->query($sql);
        }

        if ($result->num_rows > 0) {
            echo "<h1>Session booked</h1>";
                    echo "<table>
                    <tr>
                        <th>game_id</th>
                        <th>sport_id</th>
                        <th>sport_average_level</th>
                        <th>participate_number</th>
                        <th>city</th>
                        <th>time</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                $game_id = $row["game_id"];
                $sport_id  = $row["sport_id"];
                $sport_average_level = $row["sport_average_level"];
                $participate_number = $row["participate_number"];
                // compare with max participate number
                $city = $row["city"];
                $time = $row["time"];

                echo "<tr>";
                        echo "<td>".$game_id."</td>";
                        echo "<td>".$sport_id."</td>";
                        echo "<td>".$sport_average_level."</td>";
                        echo "<td>".$participate_number."</td>";
                        echo "<td>".$city."</td>";
                        echo "<td>".$time."</td>";
                        echo "<td>"."<a href='Find_game.php?user_id=$id&sport_id=$sport_id&game_id=$game_id'>Join this game</a>"."</td>";
                        echo "</tr>";

            }
            echo "</table>";
        }
        
?>
<hr>
<a href="Find_or_create.php?user_id=<?php echo $id?>">back</a>
</body>
</html>