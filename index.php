<?php
include 'phpmysql.php';
session_start();
if($_SESSION['loggedin']==true) {
	header("location: dashboard.php");
} else {
  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    //check login details
    $sql = "SELECT id, firstName, lastName, email, password FROM users where email='$email'";
    $results = $conn->query($sql);
    $rowCount = $results->num_rows;

      if($rowCount > 0) {
        while($row = $results->fetch_assoc()) {
          $firstName = $row['firstName'];
          $lastName = $row['lastName'];
          $hashed_password = $row['password'];
        };

        if (password_verify($password, $hashed_password)) {
          $_SESSION["loggedin"] = true;
          $_SESSION["sid"]=session_id();
          $_SESSION["firstName"]=$firstName;
          $_SESSION["lastName"]=$lastName;
          header("location: dashboard.php");
        }
      } else {
        header("location: index.php");
        $_SESSION['error'] = "<div>Invalid login details.</div>";
      };
    };
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='index.css'>
</head>
<body>
<div class="split left">
  <div class='centered'>
    <h4>Demo account 1</h4>
    <p>Email: johndoe@gmail.com</p>
    <p>Password: demopass1</p><br><br>
    <h4>Demo account 2</h4>
    <p>Email: janedoe@gmail.com</p>
    <p>Password: demopass2</p>
  </div>
</div>

<div class="split right">
  <div class="centered">
    <form action='' method='POST'>
        <label for="email">Email</label><br>
        <input type="email" name='email' class='spacing'><br>
        <label for="password">Password</label><br>
        <input type="password" name='password'><br>
        <button type='submit' name='login'>Log in!</button>
    </form>
    <?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; }?>
  </div>
</div>
</body>
</html>
