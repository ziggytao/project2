<?php
$favor = false;
$imageid = $_GET["id"];
$username = $_GET["username"];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "SELECT traveluser.UserName from travelimagefavor,traveluser 
WHERE travelimagefavor.ImageID = '$imageid' and traveluser.UID = travelimagefavor.UID";

if($result = mysqli_query($connection,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        if($row['UserName'] == $username){
            $favor = true;
            break;
        }
    }
    mysqli_free_result($result);
}
echo $favor;
mysqli_close($connection);