
<?php
include 'connection.php';

$imageRes=null;
$imageName=$_FILES["image"]['name'];
$error=[];

  $fileType = pathinfo($imageName, PATHINFO_EXTENSION);
  $allowTypes = array('jpg','png','jpeg'); 
  if(in_array($fileType, $allowTypes)){

    $size = filesize($_FILES['image']["tmp_name"]);
    if($size <= 1000000) {

      if ($_POST['type'] == "imgur") {
        $IMGUR_CLIENT_ID = "79d6afe0fa7977b25b1385589fed6cf2b8a13553";
        
        // Source image
        $image_source = file_get_contents($_FILES['image']['tmp_name']);
        $postFields = array('image' => base64_encode($image_source)); 
    
        // Post image to Imgur via API
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image'); 
        curl_setopt($ch, CURLOPT_POST, TRUE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID 7389f8e31f17627')); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields); 
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $imageRes=$response->data->link;
      } else {
        $target_dir = "uploads/";
        $target_file = $target_dir .date('m-d-Y_H-i-s').basename($_FILES["image"]['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES['image']["tmp_name"]);
        if ($check !== false) {
          $uploadOk = 1;
        } else {
          array_push($error, "File is not an image.");
        }
        
        if ($uploadOk == 0) {
          array_push($error, "Sorry, your file was not uploaded.");
        } else {
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $imageRes=$target_file;
          } else {
            array_push($error, "Sorry, there was an error uploading your file.");
          }
        }
      }
    } else {
      array_push($error, "File too large. File must be less than 1 MB.");
    }
  } else{ 
    array_push($error, "Sorry, only an image file is allowed to upload.");
  }

$type = $_POST['type'];
$imageColor = $_POST['imageColor'];
$description = $_POST['description'];
$cookie = $_POST['cookie'];
$date = date('Y-m-d H:i:s');

if(count($error) > 0) {
  $resultJson['status'] = "fail";
  $resultJson['message'] = "Something went wrong";
  $resultJson['error'] = $error;
} else {
  $q = "Insert into images(file_name, type, url, file_color, description, cookie, upload_date) values('$imageName', '$type', '$imageRes', '$imageColor', '$description', '$cookie', '$date')";
  $result = mysqli_query($link, $q) or die('Query not run' . mysqli_error($link));
  if (mysqli_affected_rows($link) >= 1) {
    $resultJson['status'] = "success";
    $resultJson['message'] = "Details added successfully";
  } else {
    $resultJson['status'] = "fail";
    $resultJson['message'] = "Something went wrong";
    $resultJson['error'] = $error;
  }
}

echo json_encode($resultJson);

?>