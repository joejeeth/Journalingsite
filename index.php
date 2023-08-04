<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">

    <style media="screen">

    </style>

  </head>
  <body>

    <div class="navbar">
        <h1 class="title">Blogit</h1>
        <?php
          if(isset($_SESSION['un'])){
            $un = $_SESSION['un'];
            echo "<label class=\"usern_show\">Welcome, $un</label>";
            echo"<form method=\"POST\">";
            echo"<input class=\"lg\" type=\"submit\" name=\"logout\" value=\"logout\" />";
            echo"</form>";
            if(isset($_POST["logout"])){
              setcookie('username', "", time()-3600,"/");
              setcookie('userid', "", time()-3600, "/");
              $_SESSION['un'] = null;
              $_SESSION['uid'] = null;
            }
          }
          elseif(isset($_COOKIE['username'])){
            $un = $_COOKIE['username'];
            $_SESSION['un'] = $un;
            echo "<label class=\"usern_show\">Welcome, $un</label>";
          }

          else{
            echo'<a class="lb" href="../lpage/loginpage.php"><button class="lbutton" type="button" name="login">Login</button></a>';
            echo'<a class="lb"href="../signuppage/signuppage.php"><button class="sbutton" type="button" name="signup">Signup</button></a>';
          }
        ?>

    </div>

    <div class="header">
        <h2 class="sub1">Publish your creations to the World.</h2>
        <h3 class="sub2">Create your Journal in just a few clicks.</h3>
        <form  method="post">
          <input class="cbutton"type="submit" name="cbutton" value="compose button">
        </form>
        <?php
            if(isset($_POST['cbutton'])){
              if(isset($_SESSION['un'])){
                header("Location: ../composepage/composepage.php");
              }

            else{
              header("Location: ../lpage/loginpage.php");
            }
          }
         ?>

        <!-- <a href="../composepage/composepage.php"><button class="cbutton">Compose now</button></a> -->
          <img class="homephoto" src="../ebook.gif" alt="">
    </div>

    <div class="middle">
        <div class="one">
          <img class="imgm im"src="https://cdn-icons-png.flaticon.com/512/4436/4436481.png" alt="">
          <h3>No Subscription.</h3>
          <p>Lorem Ipsum is simply dummy text of the printing.</p>
        </div>

        <div class="two">
          <img class="imgm im"src="https://cdn-icons-png.flaticon.com/512/3368/3368822.png" alt="">
          <h3>Easy to use.</h3>
          <p>Lorem Ipsum is simply dummy text of the printing.</p>
        </div>


    </div>

    <div class="footer">
          <h4 class="foottext">@Blogit</h4>
          <img class="logos l0" src="https://cdn-icons-png.flaticon.com/512/3536/3536424.png" alt="">
          <img class="logos l1" src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="">
          <img class="logos l2" src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="">
    </div>

  </body>
</html>
