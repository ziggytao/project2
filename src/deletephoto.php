<?php
$imageid = $_GET['photoid'];
$username = $_GET['username'];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "select PATH from travelimage where ImageID = '$imageid'";
$result = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($result);

//rename($row['PATH'],'../trash/'.$row['PATH']);
rename('../img/normal/medium/'.$row['PATH'],'../img/normal/trash/'.$row['PATH']);

$sql = "delete from travelimage where ImageID = '$imageid'";
mysqli_query($connection,$sql);

$sql = "delete from travelimagefavor where ImageID = '$imageid'";
mysqli_query($connection,$sql);
mysqli_free_result($result);
mysqli_close($connection);