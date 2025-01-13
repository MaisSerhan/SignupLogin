<?php
session_start();
include('config.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username=stripslashes(strtolower($_POST['username']));
    $md5_pass=md5($_POST['password']);
    $username=filter_input(INPUT_POST,'username');
    $password=stripslashes(strtolower($_POST['password']));
    $username = htmlentities(mysqli_real_escape_string($con,$_POST['username']));
    $password = htmlentities(mysqli_real_escape_string($con,$_POST['password']));

    if (empty($username)) {
    $user_error = '<p id="error">Please enter username.</p>';
    $err_s = 1;
    }
    if (empty($password) || strlen($password) < 9) {
    $password_error = '<p id="error">The password is incorrect.</p>';
    $err_s = 1;
    include('../index.php');
    }
}
if(!isset($err_s)){
    $sql="SELECT id,userName,password,privileges FROM users WHERE userName = '$username' AND md5_pass='$md5_pass'";
    $result=mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    if(empty($row)){
        echo '<p id="error">Your not in sql</p>';
        header('Location: ../ClintPages/login.php');
    }
    if($row['userName']===$username && $row['password']===$password && $row['privileges']==='Admin'){
        $_SESSION['username']=$row['userName'];//جلسة لدمج الاستطيع استدعاها في اي مكان
        $_SESSION['id']=$row['id'];
        header('Location: ../ClintPages/Users.php');
        exit();
    }
    elseif($row['userName']===$username && $row['password']===$password && $row['privileges']==='User'){
        $_SESSION['username']=$row['userName'];//جلسة لدمج الاستطيع استدعاها في اي مكان
        $_SESSION['id']=$row['id'];
        header('Location: showUser.php');
        exit();

    }
   else{
    exit();
   }
}
?>