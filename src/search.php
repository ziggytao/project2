<?php
$query = $_GET["query"];
$value = $_GET["value"];
$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}
$value = '%'.$value.'%';
$sql = "select PATH,Title,ImageID,Description from travelimage where $query like '$value'";
//echo $sql;
if($result = mysqli_query($connection,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        if(!$row['Description']){
            $row['Description'] = "There is no description yet.";
        }
        echo '<div class="pic">
							<div class="show-pic">
								<a href="pic_details.html?id='.$row['ImageID'].'">
									<img class="small" src="../img/normal/medium/'.$row['PATH'].'">
								</a>
							</div>
							<div class="description">
								<p class="description-title">'.$row['Title'].'</p>
								<p class="description-content">
									'.$row['Description'].'</p>
							</div>
						</div>';
//        echo $sql;
    }
    mysqli_free_result($result);
}
mysqli_close($connection);