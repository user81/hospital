<?php require_once('../../includes/config.php'); 
require('PHPpageScripts/idExists.php'); 
//DoctorIdExists редиретит на Doctors.php если пустая строка или такого шв нет
$row = DoctorIdExists($_GET['id'],$db);
unlink($row['image']);
$stmt = $db->prepare("DELETE FROM `doctors` WHERE id=:id");
$stmt->execute([':id' =>$_GET['id'] ]);
$error = 'Doctor delited.';
header("Location: doctors.php?error={$error}");









?>