<?php require_once('../../includes/config.php'); 
if(!$user->is_logged_in()){ header('Location: login.php'); }
require('PHPpageScripts/idExists.php'); 
//DoctorIdExists редиретит на Doctors.php если пустая строка или такого шв нет
echo print_r($_GET);
$row = DoctorIdExists($_GET['id'],$db);
$stmt = $db->prepare("DELETE FROM `patients-doctor` WHERE patient_id=:patient_id");
$stmt->execute([':patient_id' =>$_GET['patient_id'] ]);
$error = 'Pacient delited.';
 header("Location: pacients-view.php?id={$_GET['id']}");  


