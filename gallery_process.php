
<?php
include 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	$cookie = $_POST['cookie'];

  if (!empty($_POST['sortBy'])) {
    $sortBy = $_POST['sortBy'];
    $sql = "SELECT * FROM images where cookie='$cookie' ORDER BY $sortBy ASC";
  } else {
    $sql = "SELECT * FROM images where cookie='$cookie'";
  }
	$result = mysqli_query($link, $sql);
  $rowcount = mysqli_num_rows($result);

  if($rowcount == 0) {
    echo '<div>';
    echo '<div class="alert alert-secondary" role="alert">';
    echo 'Picture not found please add new one!';
    echo '</div>';
    echo '</div>';
  }

	while($row = mysqli_fetch_assoc($result))
	{
    $date=date_create($row['upload_date']);
    echo '<div class="col-3 mb-2">';
    echo  '<div class="card gallary-card mt-2 ml-2">';
    echo    '<div class="card-img-top" style="border:2px solid ; border-color:'.$row['file_color'].';">';
    echo       '<img src="'.$row['url'].'" class="img-fluid" alt="...">';
    echo    '</div>';
    echo    '<div class="card-body">';
    echo       '<p class="card-text"><b>'.$row['description'].'</b></p>';
    echo       '<p class="card-text">'. date_format($date, "l jS \of F Y").'</p>';
    echo    '</div>';
    echo  '</div>';
    echo '</div>';
	}

  // exit();


?>