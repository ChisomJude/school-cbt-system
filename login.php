<?php
session_start();
if (isset($_SESSION["username"])) {
    session_destroy();
}
include_once 'dbConnection.php';
$ref      = @$_GET['q'];
$username = $_POST['username'];
//$password = $_POST['password'];

$username = stripslashes($username);
$username = addslashes($username);
//$password = stripslashes($password);
//$password = addslashes($password);
//$password = md5($password);
$result = mysqli_query($con, "SELECT * FROM user WHERE rollno = '$username' ") or die('Error');
$count = mysqli_num_rows($result);
if ($count == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $class= $row['branch'];
         $classId= $row['class_id'];
    }
    $_SESSION["name"]     = $name;
    $_SESSION["username"] = $username;
    $_SESSION['class']=$class;
    $_SESSION['class_id']=$classId;
    header("location:account.php?q=1");
} else
    header("location:$ref?w=Wrong Username or Password");


?>