<!-- php debug -->
<?php 
    function alert($data) {
        echo "<script>alert(json_encode($data));</script>";
    }
?>
<?php
$conn = new mysqli("localhost","root","","fia3_website");

if (isset($_POST["username"])){
    $sql = "INSERT INTO `user`(`username`, `email`, `password`) VALUES ('". $_POST["username"]. "','". $_POST["email"] ."','".$_POST["password"]."')";
    $result = $conn->query($sql);
    header("Location: login.php");  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/login.css">

  <title>Login_page</title>
  <style>
    .button{
      height: 48px;
      width: 92%;
      text-align: center;
      color: #fff;
      padding: 8px;
      font: 900 20px '';
      text-transform: uppercase;
      text-decoration: none;
      font-family: sans-serif;
      box-sizing: border-box;
      background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
      background-size: 400%;
      border-radius: 30px;
      z-index: 1;
    }

    .button:before{
      content: '';
      position: absolute;
      top: -5px;
      left: -5px;
      right: -5px;
      bottom: -5px;
      z-index: -1;
      background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
      background-size: 400%;
      border-radius: 40px;
      opacity: 0;
      transition: 0.5s;
    }
    .button:hover:before{
      filter: blur(20px);
      opacity: 1;
      animation: animate 8s linear infinite;
    }
  </style>
</head>
<body>
  <div class="main">
      <div class="body">
            <div class="text">
            <p class="head">Sign in</p>
                <form name="submitForm" action="register.php" method="POST" onsubmit="return validateForm()">
                    <input type="text" class="input" placeholder="username" name="username">
                    <input type="text" class="input" placeholder="email" name="email">
                    <input type="password" class="input" placeholder="password" name="password">
                    <button type="submit" class="button">Create your account</button>
                </form>
                <a href="login.php">back to login page</a>
            </div>
          </div>
      <span></span>
  </div>

<script>
  function validateForm() {
  let x = document.forms["submitForm"]["username"].value;
  let y = document.forms["submitForm"]["email"].value;
  let z = document.forms["submitForm"]["password"].value;

  var reg = /^[0-9a-zA-Z_.-]+[@][0-9a-zA-Z_.-]+([.][a-zA-Z]+){1,2}$/;
  if (x == "") {
    alert("Username must be filled out");
    return false;
  }
  else if (y == ""){
    alert("Email must be filled out");
    return false;
  }
  else if (z == "") {
    alert("Password must be filled out");
    return false;
  }
  
}
</script>
</body>
</html>