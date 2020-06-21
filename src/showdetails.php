<?php
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$id = $_GET['id'];
$sql = "select ImageID,PATH,Title,Description,UID,Content,Country_RegionCodeISO,CityCode from travelimage where ImageId = '$id'";
if ($result = mysqli_query($connection, $sql)) {
    $count = 0;
    $rowcount = 0;
    while($row = mysqli_fetch_assoc($result)) {
        //get username
        $uid = $row['UID'];
        $sql2 = "select UserName from traveluser where UID = '$uid'";
        $result2 = mysqli_query($connection,$sql2);
        $username = mysqli_fetch_assoc($result2)['UserName'];

        //get country_region name
        $countrycode = $row['Country_RegionCodeISO'];
        $sql3 = "select Country_RegionName from geocountries_regions where ISO = '$countrycode'";
        $result3 = mysqli_query($connection,$sql3);
        $country_regionname = mysqli_fetch_assoc($result3)['Country_RegionName'];

        //get city
        $citycode = $row['CityCode'];
        $sql4 = "select AsciiName from geocities where GeoNameID = '$citycode'";
        $result4 = mysqli_query($connection,$sql4);
        $city = mysqli_fetch_assoc($result4)['AsciiName'];

        //get likeNumber
        $sql5 = "select count(FavorID) as num from travelimagefavor where ImageID = '$id'";
        $result5 = mysqli_query($connection,$sql5);
        $likeNumber = mysqli_fetch_assoc($result5)['num'];


        echo '<div class="pic-information"><div class="description-title"><p>'.$row['Title'].' <span>by <span id="author">'.$username.'</span></span></p></div>';
        echo '<div class="mainpic"><img src="../img/normal/medium/'.$row["PATH"].'"></div>';
        echo '<div class="like-frame"><ul class="like-number">';
        echo '<li><p>Like Number</p></li><li><p id="likeNumber">'.$likeNumber.'</p></li></ul>';
        echo '<ul class="img-detail">';
        echo '<li><p>Image details</p></li><li><p>Content: '.$row['Content'].'</p></li>
<li><p>Country: '.$country_regionname.'</p></li><li><p>City: '.$city.'</p></li></ul>';
        echo '<div class="like"><img src="../img/icon-favorite-white.png"><span>Like</span></div></div>';
        echo '<div class="description-content"><p class="description-content">';
        if($row['Description']){
            echo $row['Description'].'</p></div></div>';
        }else{
            echo 'There is no description yet.</p></div></div>';
        }
    }

    mysqli_free_result($result);
    mysqli_free_result($result2);
    mysqli_free_result($result3);
    mysqli_free_result($result4);
    mysqli_free_result($result5);
}
// close the database connection
mysqli_close($connection);
