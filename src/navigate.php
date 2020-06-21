<?php
$func = $_POST['func'];

$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$result = "";
$sql = "";
switch ($func){
    case 1:
        $query = $_POST['query'];
        $key = $_POST['key'];
        if($key != 'Title'){
            $sql = "select PATH,Title,ImageID from travelimage where $key = '$query'";
//            echo $sql;
        }
        else{
            $query = '%'.$query.'%';
            $sql = "select PATH,Title,ImageID from travelimage where $key like '$query'";
        }
        break;
    case 2:
        $content = isset($_POST['content']) ? $_POST['content'] : "";
        $country = isset($_POST['country']) ? $_POST['country'] : "";
        $city = isset($_POST['city']) ? $_POST['city'] : "";
        $sql = "select PATH,Title,ImageID from travelimage where";
//        $content = 'scenery';
//        $country = 'CA';
        if($content != ""){
            $sql = $sql." Content = '$content'";
        }
        if($country != "" && $content != ""){
            $sql = $sql." and Country_RegionCodeISO = '$country'";
        }elseif($country != ""){
            $sql = $sql." Country_RegionCodeISO = '$country'";
        }
        if($city != ""){
            $sql = $sql." and CityCode = '$city'";
        }
        break;
}
//echo "hi<br>";
//echo $sql;
if($result = mysqli_query($connection,$sql)){
    $count = 0;
    $rowcount = 0;
    while($row = mysqli_fetch_assoc($result)) {
        if($count == 0){
            echo "<tr>";
        }
        echo '<td>';
        echo '<a href="pic_details.html?id='.$row['ImageID'].'">';
        echo '<img class="small" src="../img/normal/medium/'.$row['PATH'].'"></a>';
        echo '</td>';
        $count++;
        if($count ==6 ){
            $count = 0;
            echo '</tr>';
            $rowcount++;
        }
        if($rowcount >= 2){
//            break;
        }
    }
    mysqli_free_result($result);
}
mysqli_close($connection);