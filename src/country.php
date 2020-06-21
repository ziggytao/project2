<?php
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "select Country_RegionName,ISO from geocountries_regions where Population > 5000000 order by Country_RegionName";
if($result = mysqli_query($connection,$sql)){
    echo '<option value="">Select a country</option>';
    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['ISO'].'">'.$row['Country_RegionName'].'</option>';
    }
    mysqli_free_result($result);
}
mysqli_close($connection);