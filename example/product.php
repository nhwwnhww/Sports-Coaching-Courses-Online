<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>40-ShowCommodity</title>
    
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/product.css">
</head>
<body>
<!-- product -->
    <div class="container bg-light">
        <div class="row d-sm-flex flex-row" style="align-items: center;">
        <?php

        // Create connection
        $conn = new mysqli("localhost", "root", "", "fia3_website");

        //connect to table
        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_max_level = $row["sport_max_level"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];

                echo '<div class="col-md-3 col-sm-4 col-6  card bg-white row-eq-height" style="height: 100%; margin-top:0.5%;">';
                    echo '<div class="product-grid">';
                        echo '<div class="product-image" style="margin-top:5px">';
                            echo '<a href="#">';
                                echo "<img class='pic-1 col-11' src='. $img_url .' alt='item'>";
                                echo "<img class='pic-2 col-11' src='. $img_url .' alt='item'>";
                            echo '</a>';
                            echo '<ul class="social">';
                                echo "<li>$sport_describe</li>";
                                echo '<li><a href="#" data-tip="Wishlist"><i class="fa fa-heart"></i></a></li>';
                            echo '</ul>';
                        echo '</div>';
                        echo '<div class="product-content">';
                            echo '<h3 class="title"><a href="#">'. $sport_name . '</a></h3>';
                            echo '<div class="price">$'. $sport_id .'</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>