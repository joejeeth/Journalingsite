<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cstyle.css">
    <title></title>
  </head>
  <body>


      <div class="navbar">
          <a class="atag" href="../indexpage/index.php"><h1 class="title">Blogit</h1></a>
          <label class="username"><?php echo"hi, " .$_SESSION['un']; ?></label>
          <form method="post">
            <input class="lbutton"type="submit" name="logout" value="logout">
          </form>
    </div>

    <div class="body">
      <h1>Compose Here</h1>
      <form method="post">
      <textarea id="texta" name="t" value="t" rows="10" cols="100"></textarea><br><br>
      <input class ="del" type="submit" name="submit" value="okay">

      </form>
        <a href="../new.php"><button class="dbutton">Display</button></a>
    </div>

    <?php

    if(isset($_SESSION['un'])){
    $u  = $_SESSION['un'];
    $uid = $_SESSION['uid'];


    $servername = "localhost";
    $user = "root";
    $password = "";
    $dbname = "blog";
    $b_id = 0;

    $con = new mysqli($servername, $user, $password, $dbname);


    if ($con->connect_error) {
      die("Connection failed: " .$con->connect_error);
    }

    if(isset($_SESSION['un'])){
    if(isset($_POST["logout"])){
      setcookie('username', "", time()-3600,"/");
      setcookie('userid', "", time()-3600, "/");
      $_SESSION['un'] = null;
      $_SESSION['uid'] = null;
      header("Location: ../indexpage/index.php");
    }

      $n_q = "select blogid from data";
      $res = $con -> query($n_q);
      while($row = $res->fetch_assoc()){
        $b_id = $row["blogid"];
      }
      $b_id = $b_id+1;

//code to edit a existing blog
      if(isset($_SESSION['e_bid'])){
          $b_id = $_SESSION['e_bid'];

              if(isset($_POST["submit"])){
                $text = $_POST["t"];
                if($text ==""){
                  echo"<script>alert('Enter Content to compose.')</script>";
                }
                else{
                $esc_t = addslashes($text);
                $q = "update data set bd=\"$text\" where blogid =$b_id";
                if($con->query($q)){
                  echo"<br />data updated";
                  unset($_SESSION['e_bid']);
                  // header("Refresh:0; url=../display.php");
                }
              }}
              }
  // code to edit ends here
      // echo"<script>alert('last blog id: $b_id')</script>";
else{
      if(isset($_POST["submit"])){
        $text = $_POST["t"];
        if($text ==""){
          echo"<script>alert('Enter Content to compose.')</script>";
        }

        else{

        $esc_t = addslashes($text);
        $q = "insert into data values('$uid', '$b_id', '$esc_t')";
        if($con->query($q)){
          echo"<br />data inserted";
        }}
        // $_SESSION['e_bid'] = NULL;
        }

        if(isset($_POST["show"])){
          $s = "select * from data";
          $res = $con->query($s);

        echo"<div class='content'> <p>";


          if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
              echo nl2br($row['d']);
              echo"<br /><br />";
            }
          }
        }
        echo"<h5></h5>";
        echo"</p>";
        echo"</div>";

}
    }
  }

    ?>


  </body>
</html>
