<?php
$imageid = $_GET['id'];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "select * from travelimage where ImageID = '$imageid'";
if($result = mysqli_query($connection,$sql)){
    $row = mysqli_fetch_assoc($result);
    $info->title = $row['Title'];
    $info->content = $row['Content'];
    $info->description = $row['Description'];
    $info->country = $row['Country_RegionCodeISO'];
    $info->city = $row['CityCode'];
    $info->path = $row['PATH'];
}

echo json_encode($info);