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

    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $user_id = $_GET['user_id'];
        $sport_id = $_GET['sport_id'];
    ?>

    <!-- skill part -->
    <?php

        $sql = "SELECT * FROM `sport` WHERE `sport_id` = $sport_id";
        $result = $conn->query($sql);

        // sport array
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_max_level = $row["sport_max_level"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];
            }
            // debug_to_console($sport_list);
        }
        ?>

<?php
        $sql = "SELECT `sport_level` FROM `skill` WHERE `user_id` = $user_id AND `sport_id` = $sport_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_level = $row["sport_level"];
            }
        }
        else {
            $insert_sql = "INSERT INTO `skill`(`user_id`, `sport_id`, `sport_level`) VALUES ('$user_id','$sport_id','1')";
            $insert_result = $conn->query($insert_sql);
            header("Location: mentor_session.php?user_id=$user_id&sport_id=$sport_id");
        }


    ?>
</head>
<body>

<!-- nav -->
<div class="m-10" id="nev" style="margin-bottom: 8%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="<?php echo $img_url?>" height="72" alt="LOGO"><h4><?php echo $sport_name?>: Your sport level is <?php echo $sport_level?></h4>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="display_sport.php?user_id=<?php echo $user_id?>" class="nav-item nav-link btn btn-danger text-white">back to sport page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $search_mentee_city_sql = "SELECT `city` FROM `user` WHERE `user_id` = '$user_id'";
        $search_mentee_city_sql_result = $conn->query($search_mentee_city_sql);
        if ($search_mentee_city_sql_result->num_rows > 0) {
            while ($row = $search_mentee_city_sql_result->fetch_assoc()) {
                $mentee_city = $row["city"];
            }
        }
        
    ?>

    <!-- get user info -->

    <?php 
        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user_list = array();
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $username = $row["username"];
                $img_url = $row["img_url"];
                $age = $row["age"];
                $phone = $row["phone"];

                $temp_array = array($user_id=>array(
                    'username'=>$username,
                    'img_url'=>$img_url,
                    'age'=>$age,
                    'phone'=>$phone,));
                array_push($user_list, $temp_array);
            }
            debug_to_console($user_list);
        }
    ?>

    <h1>Available session (Your Location is at <?php echo $mentee_city;?>)</h1>
    
    <div class="container bg-light">
    <div class="row d-sm-flex flex-row" style="align-items: center;">
    <?php
        
        $sql = "SELECT * FROM `mentor_session` WHERE `city` = '$mentee_city' AND `sport_id` = $sport_id AND NOT `mentor_id` = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="card-group row-cols-1 row-cols-md-4 g-4">';
            while ($row = $result->fetch_assoc()) {
                $session_id = $row["session_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $mentor_id = $row["mentor_id"];

                $mentor_img = $user_list[$mentor_id-1][$mentor_id]["img_url"];
                $mentor_name = $user_list[$mentor_id-1][$mentor_id]["username"];
                $mentor_age = $user_list[$mentor_id-1][$mentor_id]["age"];
                $mentor_phone = $user_list[$mentor_id-1][$mentor_id]["phone"];
                echo "<div class='col'>";
                echo '<div class="card bg-white row-eq-height h-100" style="text-align: center;">';
                    echo "<img src='$mentor_img' class='card-img-top img-thumbnail rounded mx-auto d-block' style='width:100px' alt='$mentor_name'>";
                    echo '<div class="card-body container">';
                        echo $mentor_name;
                        echo "<br>";
                        echo 'age: '.$mentor_age;
                        echo "<br>";
                        echo 'phone: '.$mentor_phone;
                        echo "<br>";
                        echo 'city: '.$city;
                        echo "<br>";
                        echo 'date: '.$date;
                    echo '</div>';
                    echo "<div class='card-footer container align-self-center' id='product_info'>";
                        echo "<a href='book_session.php?sport_id=$sport_id&city=$city&date=$date&mentor_id=$mentor_id&mentee_id=$user_id'>book</a>";
                    echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo "</div>";
        }
    ?>

    </div>
    </div>
    <h1>other session away from your location</h1>
    <div class="container bg-light">
    <div class="row d-sm-flex flex-row" style="align-items: center;">
    <?php
        
        $sql = "SELECT * FROM `mentor_session` WHERE `sport_id` = $sport_id AND NOT `city` = '$mentee_city' AND NOT `mentor_id` = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="card-group row-cols-1 row-cols-md-4 g-4">';
            while ($row = $result->fetch_assoc()) {
                $session_id = $row["session_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $mentor_id = $row["mentor_id"];

                $mentor_img = $user_list[$mentor_id-1][$mentor_id]["img_url"];
                $mentor_name = $user_list[$mentor_id-1][$mentor_id]["username"];
                $mentor_age = $user_list[$mentor_id-1][$mentor_id]["age"];
                $mentor_phone = $user_list[$mentor_id-1][$mentor_id]["phone"];
                echo "<div class='col'>";
                echo '<div class="card bg-white row-eq-height h-100" style="text-align: center;">';
                    echo "<img src='$mentor_img' class='card-img-top img-thumbnail rounded mx-auto d-block' style='width:100px' alt='$mentor_name'>";
                    echo '<div class="card-body container">';
                        echo $mentor_name;
                        echo "<br>";
                        echo 'age: '.$mentor_age;
                        echo "<br>";
                        echo 'phone: '.$mentor_phone;
                        echo "<br>";
                        echo 'city: '.$city;
                        echo "<br>";
                        echo 'date: '.$date;
                    echo '</div>';
                    echo "<div class='card-footer container align-self-center' id='product_info'>";
                        echo "<a href='book_session.php?sport_id=$sport_id&city=$city&date=$date&mentor_id=$mentor_id&mentee_id=$user_id'>book</a>";
                    echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo "</div>";
        }
    ?>
    </div>
    </div>
</body>
</html>