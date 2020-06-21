<?php
$func = $_GET['func'];
$imageid = $_GET["id"];
$username = $_GET["username"];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "SELECT UID FROM traveluser WHERE UserName = '$username'";
if($result = mysqli_query($connection,$sql)){
    $uid = mysqli_fetch_assoc($result)['UID'];
    if($func == 'un'){
        $sql1 = "DELETE FROM travelimagefavor WHERE travelimagefavor.UID = '$uid' and travelimagefavor.ImageID = '$imageid'";
    }else{
        $sql1 = "INSERT INTO travelimagefavor (FavorID, UID, ImageID) VALUES (NULL, '$uid', '$imageid')";
    }
    mysqli_query($connection,$sql1);
    mysqli_free_result($result);
}
mysqli_close($connection);