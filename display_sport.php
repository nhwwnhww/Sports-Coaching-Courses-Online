<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://kit.fontawesome.com/f01a9f988f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/product.css">
</head>
<body>
<div class="container bg-light">
<div class="row d-sm-flex flex-row" style="align-items: center;">
<?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $id = $_GET['user_id'];

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];

                echo '<div class="col-3  card bg-white row-eq-height" style="margin-top:0.5%;">';
                    echo '<div class="product-grid">';
                        echo '<div class="product-image" style="margin-top:5px">';
                            echo '<a href="#">';
                                echo "<img class='pic-1 col-11' src='$img_url' alt='item'>";
                                echo "<img class='pic-2 col-11' src='$img_url' alt='item'>";
                            echo '</a>';
                            echo '<ul class="social">';
                                echo "<li class='text-white'>Book time: $sport_book_time</li>";
                                echo "<li class='text-white'>max_participate: $sport_max_participate</li>";
                                echo "<li><a href='mentor_session.php?user_id=$id&sport_id=$sport_id' data-tip='Book it!'><i class='fa-solid fa-book'></i></a></li>";
                                echo "<li><a id='inco_$sport_id' aria-describedby='tooltip'><i class='fa-solid fa-circle-info'></i></a></li>";
                            echo '</ul>';
                        echo '</div>';
                        echo "<div class='product-content' id='product_info' data-tip='$sport_describe'>";
                            echo "<h3 class='title'><a href='mentor_session.php?user_id=$id&sport_id=$sport_id' data-tip='Book it!'>$sport_name</a></h3>";
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

                echo "<div id='tooltip_$sport_id' role='tooltip'>$sport_describe</div>";
                echo "<script>
                const inco_$sport_id = document.querySelector('#inco_$sport_id');
                const tooltip_$sport_id = document.querySelector('#tooltip_$sport_id');";
                echo "Popper.createPopper(inco_$sport_id, tooltip_$sport_id, {
                    placement: 'right',
                });
                </script>";
            }
        }
    ?>
    </div>
    </div>
    <a href="info.php?user_id=<?php echo $id?>">back</a>
</body>
</html>