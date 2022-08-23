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

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>

    <!-- user info model -->
    <link rel="stylesheet" href="./css/user_info.css">
    <!-- skill chart -->
    <link rel="stylesheet" href="./css/skill_chart.scss">

    <style>
        body{
            background-color: light gray;
        }

    </style>
</head>
<body>
    <!-- nav -->
    <div class="m-4" id="nev">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h1>Wei's sport hub</h1>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="" class="nav-item nav-link"></a>
                        <a href="display_sport.php?user_id=<?php echo $id?>" class="nav-item nav-link">book a sport</a>
                        <a href="mentor_info.php?user_id=<?php echo $id?>" class="nav-item nav-link">become a mentor</a>
                        <a href="./input_game_info.php?user_id=<?php echo $id?>" class="nav-item nav-link">Find a friendly game</a>
                        <a href="index.php" class="nav-item nav-link">log out</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Personal info
    </button>

    <!--user info model -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <!-- model head -->
            <div class="modal-header">
                <h4 class="modal-title">Your perosonal info</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
        
            <!-- model context -->
            <div class="modal-body">
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

                    }
                }
                ?>
                <div class='card-wrapper'>
                    <div class='main-window' id='main-window'>

                        <div class='user-image' style="background-image: url('<?php echo $img_url?>');">
                            <div class='username'><?php echo $username;?></div>
                        </div>
                        <div class='user-info'>
                            <div class='quote'>Email: <?php echo $email?></div>
                            <div class='quote'>Age: <?php echo $age;?></div>
                            <div class='quote'>Phone: <?php echo $phone;?></div>
                            <div class='quote'>City: <?php echo $city;?></div>
                        </div>

                    </div>
                </div>
                
            </div>
                
                
                
        
            <!-- model foot -->
            <div class="modal-footer">
                <a href="update_info.php?user_id=<?php echo $id?>" class="btn btn-primary">update</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">

    <!-- skill part -->
    <?php

        $sql = "SELECT * FROM `sport`";
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
            echo "<div class='skills'>
            <div class='charts'>
                <div class='chart chart--dev'>
                    <span class='chart__title'>Your sport skill</span>
                    <ul class='chart--horiz'>";

            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_level = $row["sport_level"];
                $find = array_column($sport_list, $sport_id);
                $sport_level_width = $sport_level * 10;
                $sport_name = $find[0]['sport_name'];

                echo "$sport_name level: $sport_level";
                echo "<li class='chart__bar' style='width: $sport_level_width%;'>";
                echo "<span class='chart__label'>";
                echo     "$sport_name";
                echo "</span>";
                echo "</li>";
            }
            echo "</ul>
            </div>
        </div>
        
        </div>";
        }
    ?>

    <div class="col">

<?php

        $sql = "SELECT `user_id`,`username` FROM `user`;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user_list = array();
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $username = $row["username"];

                $temp_array = array($user_id=>array(
                    'user_id'=>$user_id,
                    'username'=>$username,
                ));
                array_push($user_list, $temp_array);
            }
        };

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
                $mentor_id = $row["mentor_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $feedback = $row["feedback"];

                $find = array_column($user_list, $mentor_id);
                $user_list = $find[0]['username'];

                echo "<tr>";
                echo "<td>".$user_list."</td>";
                echo "<td>".$sport_name."</td>";
                echo "<td>".$city."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$feedback."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
    </div>
    </div>

    </div>

    
</body>
</html>