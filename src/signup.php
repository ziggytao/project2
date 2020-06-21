<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$conn = mysqli_connect("localhost", "root", "ziggytao", "travels"); //准备SQL语句,查询用户名
$sql_select = "SELECT UserName FROM traveluser WHERE UserName = '$username'"; //执行SQL语句
$date = date("Y-m-d H:i:s");
$state = 1;
$ret = mysqli_query($conn, $sql_select);
$row = mysqli_fetch_assoc($ret);
if ($username == $row['UserName']) { //用户名已存在，显示提示信息
    header("Location:sign_up.html?err=1");
} else {
    $sql_insert = "INSERT INTO traveluser(Email,UserName,Pass,State,DateJoined,DateLastModified) VALUES('$email','$username','$password','$state','$date','$date')"; //执行SQL语句
    if(mysqli_query($conn, $sql_insert)){
        header("Location:signin.html");
//        echo "success"."<br>".$sql_insert;
    }else{
        echo "error"."<br>".$sql_insert;
    }
} //关闭数据库
mysqli_close($conn);