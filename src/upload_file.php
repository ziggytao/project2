<?php
session_start();
$update = $_GET['update'];
$username = $_SESSION['user'];
$title = $_POST['img-title'];
$description = $_POST['img-description'];
$country = $_POST['country'];
$city = $_POST['city'];
$content = $_POST['content'];

$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
if($update == 1){
    $imageid = $_GET['id'];
    $sql = "UPDATE travelimage SET Title = '$title',Description = '$description',Country_RegionCodeISO = '$country',
CityCode = '$city',Content = '$content' WHERE travelimage.ImageID = '$imageid'";
    mysqli_query($connection,$sql);
    header("Location:my-photo.html");
}else{
    if ($_FILES["upload-file"]["error"] > 0)
    {
        echo "错误：" . $_FILES["upload-file"]["error"] . "<br>";
    }else{

        if (file_exists("../img/normal/medium/" . $_FILES["upload-file"]["name"]))
        {
            echo $_FILES["upload-file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            $newname = rand().$_FILES["upload-file"]["name"];
            move_uploaded_file($_FILES["upload-file"]["tmp_name"], "../img/normal/medium/".$newname );

            $sql3 = "select UID from traveluser where UserName = '$username'";
            $result3 = mysqli_query($connection,$sql3);
            $uid = mysqli_fetch_assoc($result3)['UID'];

            $sql4 = "INSERT INTO travelimage (ImageID, Title, Description, CityCode, Country_RegionCodeISO, UID, PATH, Content) 
VALUES (NULL, '$title', '$description', '$city', '$country', '$uid', '$newname', '$content')";
            echo $sql4;

            mysqli_query($connection,$sql4);
            header("Location:my-photo.html");
//        mysqli_free_result($result1);
            mysqli_free_result($result3);
//        mysqli_free_result($result2);
        }
    }
}

mysqli_close($connection);