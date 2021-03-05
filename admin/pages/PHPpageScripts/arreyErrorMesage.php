<?php

function arrayInputErrors($post){
  $error=[];
    if ($post['DoctorName'] == '') {
      $error[] = 'Please enter the username.';
    }
    if ($post['DoctorEmail'] == '') {
      $error[] = 'Please enter the email address.';
    }
    if ($post['DoctorPassword'] == '') {
      $error[] = 'Please enter the password.';
    }
    if ($post['DoctorPhone'] == '') {
      $error[] = 'Please enter the phone.';
    }
    if ($post['Gender'] == '') {
      $error[] = 'Please select gender.';
    }
    if ($post['Specialist'] == '') {
      $error[] = 'Please select gender.';
    }
    if ($post['WorkingStatus'] == '') {
      $error[] = 'Please select working status.';
    }
    return $error;
}
//проверяет выбрана ли картина и выводит ссобщение
/* function arrayErrors($files,$post){
  $error= [];
 $error= arrayInputErrors($post);
 if ( $files['DoctorImg']['name'] == '' ) {
  $error[] = 'Please enter the image.';
}
      if (!isset($error)) {
        if (isset($files['DoctorImg']) && $files['DoctorImg']['error'] === UPLOAD_ERR_OK) {
          // get details of the uploaded file
          $fileTmpPath = $files['DoctorImg']['tmp_name'];
          $fileName = $files['DoctorImg']['name'];
          $fileSize = $files['DoctorImg']['size'];
          $fileType = $files['DoctorImg']['type'];
          $fileNameCmps = explode(".", $fileName);
          $fileExtension = strtolower(end($fileNameCmps));
          // sanitize file-name
          $newFileName = $fileName;
          // check if file has one of the following extensions
          $allowedfileExtensions = array('jpg', 'png');

          if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../dist/img/doctors/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
            }
          } else {
            $error[] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
          }
        } else {
          $error[] = 'There is some error in the file upload. Please check the following error.<br>' . " " . 'Error:' . $files['DoctorImg']['error'];
        }
      }
      return $error;
} */


//проверяет выбрана ли картина и выводит ссобщение
function filesErrors($files,$post){
  $posrError=[];
  $posrError= arrayInputErrors($post);
  $fileError=[];
  if ( $files['DoctorImg']['name']  == '') {
    $fileError[] = 'Please enter the image.';
  }
      if (count($posrError) == 0 && count($fileError) == 0) {
        if (isset($files['DoctorImg']) && $files['DoctorImg']['error'] === UPLOAD_ERR_OK) {
          // get details of the uploaded file
          $fileTmpPath = $files['DoctorImg']['tmp_name'];
          $fileName = $files['DoctorImg']['name'];
          $fileSize = $files['DoctorImg']['size'];
          $fileType = $files['DoctorImg']['type'];
          $fileNameCmps = explode(".", $fileName);
          $fileExtension = strtolower(end($fileNameCmps));
          // sanitize file-name
          $newFileName = $fileName;
          // check if file has one of the following extensions
          $allowedfileExtensions = array('jpg', 'png');

          if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../dist/img/doctors/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
            }
          } else {
            $fileError[] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
          }
        } else {
          $fileError[] = 'There is some error in the file upload. Please check the following error.<br>' . " " . 'Error:' . $files['DoctorImg']['error'];
        }
        /* return $fileError; */
      }
      return $fileError;
}













 ?>