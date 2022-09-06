<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
</head>
<body>

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

                if ($is_admin == ""){
                    $display_admin = 'invisible';
                };
            }
        }
?>

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
                            <a href="index.php" class="nav-item nav-link btn btn-danger text-white me-2">log out</a>
                            <a href="./info.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-danger text-light me-2">back</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>


        <div class="row">
        <div class="col">
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
?>


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

$sql_book = "SELECT * FROM `book`";
$result_book = $conn->query($sql_book);

if ($result_book->num_rows > 0) {
    echo "<h1>Session booked</h1>";
    echo "<table class='table table-striped table-hover'>
    <tr>
        <th>mentor_name</th>
        <th>mentee_name</th>
        <th>sport_id</th>
        <th>city</th>
        <th>date</th>
        <th>feedback</th>
    </tr>";

    while ($row = $result_book->fetch_assoc()) {
        $mentor_id = $row["mentor_id"];
        $mentee_id = $row["mentee_id"];
        $sport_id = $row["sport_id"];
        $city = $row["city"];
        $date = $row["date"];
        $feedback = $row["feedback"];
        $book_id = $row["book_id"];

        $find = array_column($sport_list, $sport_id);
        $sport_name = $find[0]['sport_name'];

        // debug_to_console($mentor_id);
        $mentor_id_array = intval($mentor_id) - 1;
        $mentee_id_array = intval($mentee_id) - 1;

        $mentor_name = $user_list[$mentor_id_array]["username"];
        $mentee_name = $user_list[$mentee_id_array]["username"];

        echo "<tr>";
        echo "<td>".$mentor_name."</td>";
        echo "<td>".$mentee_name."</td>";
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
<div class="col">
<!-- game info -->
<?php                
// participate array
$sql = "SELECT * FROM `participate`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h1>Matched Game</h1>";
    echo "<table class='table table-striped table-hover'>
            <tr>
                <th>participate_id</th>
                <th>user_id</th>
                <th>sport_id</th>
                <th>sport_level</th>
                <th>game_id</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $participate_id   = $row["participate_id"];
        $user_id   = $row["user_id"];
        $sport_id  = $row["sport_id"];
        $sport_level  = $row["sport_level"];
        $game_id   = $row["game_id"];

        echo "<tr>";
        echo "<td>".$participate_id."</td>";
        echo "<td>".$user_id."</td>";
        echo "<td>".$sport_id."</td>";
        echo "<td>".$sport_level."</td>";
        echo "<td>".$game_id."</td>";
        echo "</tr>";
        
    };
    echo "</table>";
}
?>
</div>
</div>
</body>
</html>