<?php
$country = $_GET['country'];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$sql = "select AsciiName,GeoNameID from geocities
 where Population > 300000 and Country_RegionCodeISO = '$country'
 order by AsciiName";
if($result = mysqli_query($connection,$sql)){
    echo '<option value="">Select a city</option>';
    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['GeoNameID'].'">'.$row['AsciiName'].'</option>';
    }
    mysqli_free_result($result);
}
mysqli_close($connection);