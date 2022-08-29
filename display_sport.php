<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://kit.fontawesome.com/f01a9f988f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/product.css">

</head>
<body>
    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $id = $_GET['user_id'];
    ?>
    <!-- nav -->
    <div class="m-10" id="nev" style="margin-bottom: 8%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h1>Wei's sport hub</h1>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="info.php?user_id=<?php echo $id?>" class="nav-item nav-link">back to info page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>



<div class="container bg-light">
<div class="row d-sm-flex flex-row" style="align-items: center;">
<?php

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="card-group row-cols-1 row-cols-md-2 g-4">';
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];

                echo "<div class='col'>";
                echo '<div class="card bg-white row-eq-height h-100" style="text-align: center;">';
                    echo '<div class="product-grid card-img-top">';
                        echo '<div class="product-image">';
                            echo '<a href="#">';
                                echo "<img class='pic-1' src='$img_url' alt='item'>";
                                echo "<img class='pic-2' src='$img_url' alt='item'>";
                            echo '</a>';
                            echo '<ul class="social">';
                            echo "<li class='text-white'>Book time: $sport_book_time</li>";
                            echo "<li class='text-white'>max_participate: $sport_max_participate</li>";
                            echo "<li><a href='mentor_session.php?user_id=$id&sport_id=$sport_id' data-tip='Book it!'><i class='fa-solid fa-book'></i></a></li>";
                            echo '</ul>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="card-body container">';
                            echo "<p>$sport_describe</p>";
                            echo '</div>';
                            echo "<div class='card-footer container align-self-center' id='product_info'>";
                            echo '</div>';
                        echo "<h3 class='title'><a href='mentor_session.php?user_id=$id&sport_id=$sport_id' data-tip='Book it!'>$sport_name</a></h1>";
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