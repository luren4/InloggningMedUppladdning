<?php
session_start();
if(isset($_SESSION["username"]))
{

  $target_dir = "uploads/";
  $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;

  echo ("<br>$target_file<br>");

  // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is an actual image or fake image


  if(isset($_POST["submit"])) 
  {

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }


  // Check file size
  $one_kB = 1024;
  $file_size_limit = 500 * $one_kB;
  if ($_FILES["fileToUpload"]["size"] > $file_size_limit) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
  if (
    $imageFileType != "jpg"
    && $imageFileType != "png"
    && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

      $myfile = fopen("data.txt", "a+") or die("Unable to open file!");
      $bilden = basename($_FILES["fileToUpload"]["name"]);
      $txt = $_SESSION["username"];
      $txt2 = "  har postat bilden:  ";
      $txt3 = $bilden;
      $txt4 = "\n";
      fwrite($myfile, $txt);
      fwrite($myfile, $txt2);
      fwrite($myfile, $txt3);
      fwrite($myfile, $txt4);
      fclose($myfile);
      


    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

?>
