<?php
$q = $_GET['q'];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$result = "";
$sql = "";
switch ($q){
    case 1:
        echo '<tr>
					<td class="aside-td first-td">
						<div>Hot Contents</div>
					</td>
				</tr>';
        $sql = "select Content,COUNT(ImageID) as num from travelimage group by Content ORDER by num DESC";
        break;
    case 2:
        echo '<tr>
					<td class="aside-td first-td">
						<div>Hot Countries</div>
					</td>
				</tr>';
        $sql = "select Country_RegionCodeISO,COUNT(ImageID) as num from travelimage group by Country_RegionCodeISO ORDER by num DESC";
        break;
    case 3:
        echo '<tr>
					<td class="aside-td first-td">
						<div>Hot Cities</div>
					</td>
				</tr>';
        $sql = "select CityCode ,COUNT(ImageID) as num from travelimage group by CityCode ORDER by num DESC";
        break;
}
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
//echo $sql;
if($result = mysqli_query($connection,$sql)){
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        if ($count >= 4){
            break;
        }
        switch ($q){
            case 1:
                $class = "Content";
                $name = $value = $row['Content'];
                break;
            case 2:

                $class = "Country_RegionCodeISO";
                //get country_region name
                $name = $countrycode = $row['Country_RegionCodeISO'];
                $sql3 = "select Country_RegionName from geocountries_regions where ISO = '$countrycode'";
                $result3 = mysqli_query($connection,$sql3);
                $value = mysqli_fetch_assoc($result3)['Country_RegionName'];
                break;
            case 3:

                $class = "CityCode";
                //get city
                $name = $citycode = $row['CityCode'];
                $sql4 = "select AsciiName from geocities where GeoNameID = '$citycode'";
                $result4 = mysqli_query($connection,$sql4);
                $value = mysqli_fetch_assoc($result4)['AsciiName'];
                break;
        }
//        <td class="aside-td">
//            <div class="asidelink">
//                <span class="Content" name="scenery">Scenery</span>
//            </div>
//        </td>
        if($name != "" && $class != "" && $value != ""){
            $count++;
            echo '<tr><td class="aside-td"><div class="asidelink"><label class="'.$class.'" name="'.$name.'">'.$value.'</label></div></td></tr>';
        }
    }
    mysqli_free_result($result);
}
mysqli_close($connection);