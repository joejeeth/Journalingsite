<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="loginstyle.css">
    <meta charset="utf-8">
    <title>Login page</title>
  </head>
  <body>

    <div class="navbar">
        <a class="atag" href="../indexpage/index.php"><h1 class="title">Blogit</h1></a>
        <a class="lb"href="../signuppage/signuppage.php"><button class="sbutton" type="button" name="signup">Signup</button></a>
    </div>

    <div class="d">
      <form class="" action="" method="post">

    <h2 class="ltitle">LOGIN PAGE</h2>
    <input class="box" type="text" name="uname" placeholder="email or userid" value="" autofocus><br><br>
    <input class="box" type="password" name="password" placeholder="password" value=""><br><br>
    <input type = hidden name="keepl" value="0"/>
    <input class="cbox" type="checkbox" name="keepl" value="1"/>
    <label class="cboxl" for="keepl">keep me logged in.</label>
    <a class="slink" href="../signuppage/signuppage.php">don't have an account?</a>
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


$keep_log = $_POST["keepl"];

$uname = $_POST["uname"];
$ps = $_POST["password"];

if(empty($uname && $ps)){

  echo"<script>alert('do not leave any box empty')</script>";
  die();
}


$con = new mysqli($servername, $user, $password, $dbname);

if($con-> connect_error){
echo "error connecting to the database";
}


$q = "select * from user";

$res = $con->query($q);
$found_id = 0;

  while($row = $res->fetch_assoc()){
      if(($row["username"] == $uname ) && $row["password"] == $ps){
        session_start();
        $_SESSION["un"] = $row["username"];
        $s_un = $_SESSION["un"];
        $found_id = 1;
        $_SESSION["uid"] = $row["userid"];
        if($keep_log == "1"){
           // (86400 * 30)
          setcookie("username", $uname, time() + 3600, "/");
          setcookie("userid", $row["userid"], time() +3600, "/");

        }

        header("Location: ../composepage/composepage.php");
      }

  }

  if($found_id == 0){

      echo"<script>alert('username or password is wrong')</script>";
      die();

  }


}
 ?>

  </body>
</html>
