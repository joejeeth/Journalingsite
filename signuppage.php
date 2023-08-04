<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="signupstyle.css">
    <title>Signup page</title>
  </head>
  <body>

    <div class="navbar">
        <a href="../indexpage/index.php"><h1 class="title">Blogit</h1></a>
        <a class="lb"href="../lpage/loginpage.php"><button class="lbutton" type="button" name="signup">Login</button></a>

    </div>

    <div class="d">
      <form class="" action="" method="post">


    <h2 class="stitle">SIGN UP PAGE</h2>
    <input class="box" type="text" name="uname" placeholder="username" value="" autofocus><br><br>
    <input class="box" type="email" name="email" placeholder="email id" value=""><br><br>
    <input class="box" type="password" name="ps" placeholder="password"value=""><br><br>
    <input class="box" type="password" name="rps" placeholder="re-type password"value=""><br><br><br>
    <a href="../lpage/loginpage.php">already have an account?</a>
    <input class="sub" type="submit" name="submit" value="submit">

    </form>
    </div>
    <?php

    if(isset($_POST["submit"])){

    $dbname ="blog";
    $tabname = "user";
    $servername="localhost";
    $password="";
    $user = "root";

    $con = new mysqli($servername, $user, $password, $dbname);

    if($con-> connect_error){
    echo " <script> alert('error connecting to the database') </script>";
    }

    $uname = $_POST["uname"];
    $ps = $_POST["ps"];
    $email = $_POST["email"];
    $rps = $_POST["rps"];
    $c =0;

    if(empty($uname && $ps && $email && $rps)){
      echo"<script>alert('do not leave any box empty')</script>";
      die();
    }
    else{

    if($ps!=$rps){
      echo"<script>alert('password mismatch')</script>";
      die();
    }
    else{
      $q = "select * from user";

      $res = $con->query($q);

        while($row = $res->fetch_assoc()){
          $c = $row["userid"];
          if($row["username"] == $uname){
            echo"<script>alert('username already exists')</script>";
            die();
          }
          elseif ($row["email"] == $email) {
            echo"<script>alert('this email is registered with another account')</script>";
            die();
          }
        }
        $c = $c+1;
        $q = "insert into user values('$c', '$uname', '$email', '$ps')";
        $r = $con->query($q);
        if($r){
        $_SESSION['un'] = $uname;
        $u  = $_SESSION['un'];
        // echo"<script>alert('account created successfully')</script>";
        $_SESSION['uid'] = $c;

        header("Location: ../composepage/composepage.php");


      }
      else{
        echo"<script>alert('account not created ')</script>";
      }

    }
  }
  }
     ?>
  </body>
</html>
