<?php
$username = $_GET['username'];

$connection = mysqli_connect("localhost", "root", "ziggytao", "travels");
if ( mysqli_connect_errno() ) {
    die( mysqli_connect_error() );
}

$sql = "SELECT travelimage.PATH,travelimage.Title,travelimage.ImageID,travelimage.Description  from travelimage,traveluser,travelimagefavor 
WHERE traveluser.UserName = '$username' and travelimagefavor.UID = traveluser.UID and travelimagefavor.ImageID = travelimage.ImageID";
if($result = mysqli_query($connection,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        if(!$row['Description']){
            $row['Description'] = "There is no description yet.";
        }
        echo '<div class="pic">
							<div class="show-pic" id="'.$row['ImageID'].'">
								<a href="pic_details.html?id='.$row['ImageID'].'">
									<img class="small" src="../img/normal/medium/'.$row['PATH'].'">
								</a>
							</div>
							<div class="description">
								<p class="description-title">'.$row['Title'].'</p>
								<p class="description-content">
									'.$row['Description'].'</p>
							</div>
							<div class="edit-btn">
                                <button class="delete-btn">Delete</button>
						    </div>
						</div>';
    }
    mysqli_free_result($result);
}
mysqli_close($connection);