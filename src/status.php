<?php
session_start();
$func = $_GET['func'];
if($func == 1){
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $conn = mysqli_connect("localhost", "root", "ziggytao", "travels"); //准备SQL语句,查询用户名
    $sql_select = "SELECT Pass,UserName FROM traveluser WHERE UserName = '$username'"; //执行SQL语句
    if($ret = mysqli_query($conn, $sql_select)){
        $row = mysqli_fetch_array($ret);
        if($row['Pass'] == $password && $username == $row['UserName']){
            unset($_SESSION['user']);
            $_SESSION['user'] = $username;
            header("Location:../index.html");
        }else{
            header("Location:signin.html?err=1");
        }
        mysqli_free_result($ret);
    }else{
        header("Location:signin.html?err=1");
    }

    mysqli_close($conn);
}elseif ($func == 2){
    session_destroy();
    header("Location:../index.html");
}elseif ($func == 3){
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : "";
    if($username != ""){
        echo $username;
    }else{
        echo 'Sign in!';
    }
}