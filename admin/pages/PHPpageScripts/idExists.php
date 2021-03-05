
<?php 
function DoctorIdExists($getId,$db){
  
    if ($getId == '') {
        $error = 'Doctor id Id not specified.';
        header("Location: doctors.php?error={$error}");
    }
    $stmt = $db->prepare("SELECT * FROM doctors WHERE id=:id");
    $stmt->execute([':id' =>$getId ]);
    $row = $stmt->fetch();
    $bool =  $row > 0 ? true : false;
    if ($bool== false) {
        $error = 'Doctor Id not exist.';
        header("Location: doctors.php?error={$error}");  
    }

return $row;
}




?>