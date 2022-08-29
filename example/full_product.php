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
<!-- shopping cart button -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart" title="Click me to view cart">Cart (<span class="total-count"></span>)<span><i class="shopping-cart"></i></span></button>
<!-- clear shopping cart button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#trash-bin">Clear Cart<span><i class="trash-bin"></i></span></button>

<!-- product -->
    <div class="container bg-light">
        <div class="row d-sm-flex flex-row" style="align-items: center;">
        <?php

        // Create connection
        $conn = new mysqli("localhost", "root", "", "fia3_website");

        //connect to table
        $sql = "SELECT * FROM product_table_cpu";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $id = $row["id"];
                $name = $row["name"];
                $price = $row["price"];
                $product = "cpu";

                echo '<div class="col-md-3 col-sm-4 col-6  card bg-white row-eq-height" style="height: 100%; margin-top:0.5%;">';
                    echo '<div class="product-grid">';
                        echo '<div class="product-image" style="margin-top:5px">';
                            echo '<a href="#">';
                                echo '<img class="pic-1 col-11" src="./old game shop/product/cpu/'. $id .'.png" alt="item">';
                                echo '<img class="pic-2 col-11" src="./old game shop/product/cpu/'. $id .'.png" alt="item">';
                            echo '</a>';
                            echo '<ul class="social">';
                                echo '<li><a href="#" data-tip="Add to Cart" class="add-to-cart" data-name="'. $name . '" data-price="'. $price .'"><i class="fa fa-shopping-cart"></i></a></li>';
                                echo '<li><a href="#" data-tip="Wishlist"><i class="fa fa-heart"></i></a></li>';
                            echo '</ul>';
                        echo '</div>';
                        echo '<div class="product-content">';
                            echo '<h3 class="title"><a href="#">'. $name . '</a></h3>';
                            echo '<div class="price">$'. $price .'</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
        ?>
        </div>
    </div>
</div>

<!-- clear cart Modal -->

<div class="modal fade" id="trash-bin">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
   
        <div class="modal-header">
          <h4 class="modal-title">Clear Your Shopping Cart</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
   
        <div class="modal-body">
          Are you sure to clear your shopping cart?
        </div>
   
        <div class="modal-footer">
            <button type="button" class="clear-cart btn btn-danger" data-dismiss="modal">CLEAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </div>
   
      </div>
    </div>
  </div>

<!-- cart Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shopping Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table">
          
        </table>
        <div>Total price: $<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Order now</button>
      </div>
    </div>
  </div>
</div> 
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="./js/add-to-cart.js"></script>
<script src="./js/shopping_cart.js"></script>
</body>
</html>