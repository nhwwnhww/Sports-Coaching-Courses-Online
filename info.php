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

    <?php 
        $conn = new mysqli("localhost","root","","fia3_website");

        $id = $_GET['user_id'];
        $sql = "SELECT * FROM `user` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $display_city_required = 'block';
            $display_admin = 'visible';
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $username = $row["username"];
                $password = $row["password"];
                $img_url = $row["img_url"];
                $city = $row["city"];
                $email = $row["email"];
                $age = $row["age"];
                $phone = $row["phone"];
                $is_admin = $row["is_admin"];

                if (!$city == ""){
                    $display_city_required = 'none';
                };

                if ($is_admin == "" | $is_admin == "0"){
                    $display_admin = 'invisible';
                };
            }
        }
    ?>
</head>
<body class="bg-light" style="overflow-x: hidden;">
    <!-- nav -->
    <div class="m-10" id="nev" style="margin-bottom: 10%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="<?php echo $img_url?>" height="72" alt="LOGO"><h1><?php echo $username?></h1>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="admin_page.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-primary text-light me-2 <?php echo $display_admin?>">Admin page</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#myModal" class="nav-item nav-link btn btn-primary text-light me-2">personal info</a>
                            <a href="display_sport.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-primary text-light me-2">book a sport</a>
                            <a href="mentor_info.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-primary text-light me-2">become a mentor</a>
                            <a href="./Find_or_create.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-primary text-light me-2">Find a friendly game</a>
                            <a href="index.php" class="nav-item nav-link btn btn-danger text-white">log out</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-3">
            <div class='card-wrapper bg-dark' style="width: 100%;">
                <div class='main-window bg-dark text-white' id='main-window'>

                    <div class='user-image' style="background-image: url('<?php echo $img_url?>');">
                        <div class='username'><?php echo $username;?></div>
                    </div>
                    <div class='user-info' style="display: flex;margin-top: 12%;margin-left: 10%;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="width:80%">
                            More detail
                        </button>
                    </div>

                </div>
            </div>
        </div>
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
                <div class='card-wrapper bg-dark'>
                    <div class='main-window bg-dark text-white' id='main-window'>

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
        <div class="col-3">

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
                echo "<h1>Sport skill</h1>";
                echo "<div class='skills mb-5'>
                <div class='charts'>
                    <div class='chart chart--dev'>
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
        <a href='display_sport.php?user_id=<?php echo $id?>' class="btn btn-primary">book a sport</a>
        <hr>
        <a href='mentor_info.php?user_id=<?php echo $id?>' class="btn btn-primary">become a mentor</a>
        <br>
        <span style="display: <?php echo $display_city_required;?>;">You need update your city infomation to become a mentor</span>
        <hr>
        <a href='./Find_or_create.php?user_id=<?php echo $id?>' class="btn btn-primary">Find a friendly game</a>
        </div>

        <div class="col-4">
            <!-- booked session -->
        <?php

                $sql = "SELECT `user_id`,`username` FROM `user`;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user_list = array();
                    while ($row = $result->fetch_assoc()) {
                        $username = $row["username"];

                        $temp_array = array('username'=>$username);
                        array_push($user_list, $temp_array);
                        // debug_to_console($user_list);
                    }
                };

                $sql_book = "SELECT * FROM `book` WHERE `mentee_id` = $user_id";
                $result_book = $conn->query($sql_book);

                if ($result_book->num_rows > 0) {
                    echo "<h1>Session booked</h1>";
                    echo "<table class='table table-striped table-hover'>
                    <tr>
                        <th>mentor_name</th>
                        <th>sport_id</th>
                        <th>city</th>
                        <th>date</th>
                        <th>feedback</th>
                    </tr>";

                    while ($row = $result_book->fetch_assoc()) {
                        $mentor_id = $row["mentor_id"];
                        $sport_id = $row["sport_id"];
                        $city = $row["city"];
                        $date = $row["date"];
                        $feedback = $row["feedback"];
                        $book_id = $row["book_id"];

                        $find = array_column($sport_list, $sport_id);
                        $sport_name = $find[0]['sport_name'];

                        // debug_to_console($mentor_id);
                        $mentor_id_array = intval($mentor_id) - 1;

                        $mentor_name = $user_list[$mentor_id_array]["username"];

                        echo "<tr>";
                        echo "<td>".$mentor_name."</td>";
                        echo "<td>".$sport_name."</td>";
                        echo "<td>".$city."</td>";
                        echo "<td>".$date."</td>";
                        if ($feedback == ''){
                            echo "<td><a href='./feedback.php?book_id=$book_id&user_id=$id&mentor_name=$mentor_name&sport_name=$sport_name&city=$city&date=$date'>add a feedback</a></td>";
                        }
                        else{echo "<td>".$feedback."</td>";};
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>

            <!-- game info -->
            <?php                
                // participate array
                $sql = "SELECT * FROM `participate` WHERE `user_id` = $id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $participate = array();
                    while ($row = $result->fetch_assoc()) {
                        $user_id  = $row["user_id"];
                        $sport_id  = $row["sport_id"];
                        $sport_level = $row["sport_level"];
                        $game_id = $row["game_id"];

                        $temp_array = array($user_id=>array(
                            'sport_id'=>$sport_id,
                            'sport_level'=>$sport_level,
                            'game_id'=>$game_id,));
                        array_push($participate, $temp_array);
                    }
                    $find = array_column($participate, $id);
                    echo "<h1>Matched Game</h1>";
                    echo "<table class='table table-striped table-hover'>
                            <tr>
                                <th>game_id</th>
                                <th>sport_id</th>
                                <th>sport_average_level</th>
                                <th>participate_number</th>
                                <th>city</th>
                                <th>time</th>
                            </tr>";
                    for ($i = 0; $i < sizeof($find);$i++){
                        $game_id = $find[$i]['game_id'];
                        // search game info
                        $sql = "SELECT * FROM `game` WHERE `game_id` = $game_id";
                        $result = $conn->query($sql);
    
                        if ($result->num_rows > 0) {
                               
                            while ($row = $result->fetch_assoc()) {
                                $game_id = $row["game_id"];
                                $sport_id = $row["sport_id"];
                                $sport_average_level = $row["sport_average_level"];
                                $participate_number = $row["participate_number"];
                                $city = $row["city"];
                                $time = $row["time"];
                                echo "<tr>";
                                echo "<td>".$game_id."</td>";
                                echo "<td>".$sport_id."</td>";
                                echo "<td>".$sport_average_level."</td>";
                                echo "<td>".$participate_number."</td>";
                                echo "<td>".$city."</td>";
                                echo "<td>".$time."</td>";
                                echo "</tr>";
                            }
                        }
                    };
                    echo "</table>";
                }
            ?>
            </div>
            <div class="col-1">

        </div>
    </div>
</body>
</html>