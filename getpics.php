<?php
$query = isset($_GET['q']) ? $_GET['q'] : "";
$username = isset($_SESSION['user']) ? $_SESSION['user'] : "";
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
if($query == "favor"){
    $favorsql = "select ImageID,count(*) as num from travelimagefavor group by ImageID order by num desc";
    if($favorresult = mysqli_query($connection,$favorsql)){
        $mostfavored = mysqli_fetch_assoc($favorresult)['ImageID'];
        $searchsql = "select PATH from travelimage where ImageID = '$mostfavored'";
        $searchresult = mysqli_query($connection,$searchsql);
        $path = mysqli_fetch_assoc($searchresult)['PATH'];
        echo '<a href="src/pic_details.html?id='.$mostfavored.'"><img src="img/normal/medium/'.$path.'"></a>';
        mysqli_free_result($favorresult);
        mysqli_free_result($searchresult);
    }
}else{
    $sql = "select ImageID,PATH,Title,Description from travelimage order by rand() limit 12";
    if ($result = mysqli_query($connection, $sql)) {
        // loop through the data
        $count = 0;
        $rowcount = 0;
        while($row = mysqli_fetch_assoc($result)) {
            if($count == 0){
                echo "<tr>";
            }
            echo '<td>';
            echo '<a href="src/pic_details.html?id='.$row['ImageID'].'">';
            echo '<img class="small" src="img/normal/medium/'.$row['PATH'].'"></a>';
            echo '<div class="description">';
            echo '<p class="description-title">'.$row['Title'].'</p>';
            if($row['Description'])
                echo '<p class="description-content">'.$row['Description'].'</p>';
            else
                echo '<p class="description-content">No description</p>';
            echo '</div></td>';
            $count++;
            if($count ==6 ){
                $count = 0;
                echo '</tr>';
                $rowcount++;
            }
            if($rowcount >= 2){
                break;
            }
        }
//    echo "</table>";
        // release the memory used by the result set
        mysqli_free_result($result);
    }
}
// close the database connection
mysqli_close($connection);
