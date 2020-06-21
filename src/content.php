<?php
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "select Content from travelimage group by Content";
if($result = mysqli_query($connection,$sql)){
    echo '<option value="">Select a content</option>';
    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['Content'].'">'.$row['Content'].'</option>';
    }
    mysqli_free_result($result);
}
mysqli_close($connection);