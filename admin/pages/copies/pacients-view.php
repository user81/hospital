<?php require_once('../../includes/config.php');
require('PHPpageScripts/idExists.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php
        $error = [];
        if (isset($_GET['error'])) {
            array_push($error, $_GET['error']);
        }
 
        $rowDoctor = DoctorIdExists($_GET['id'], $db);
        $stmt = $db->prepare("SELECT   doctors.name As doctorsName, patients.id, patients.image, patients.name, patients.phone,
        patients.gender, patients.health_condition, patients.created
        FROM doctors
        INNER JOIN `patients-doctor` ON `patients-doctor`.doctor_id = doctors.id
        INNER JOIN patients ON `patients-doctor`.patient_id = patients.id
        WHERE doctors.id = :id");
        $stmt->execute(array(
            ':id' => $rowDoctor['id'],
        ));
        $pacientsNamesStmt = $db->prepare("SELECT * from `patients` where patients.id NOT IN
        (SELECT patients.id
        FROM doctors
        INNER JOIN `patients-doctor` ON `patients-doctor`.doctor_id = doctors.id
        INNER JOIN patients ON `patients-doctor`.patient_id = patients.id
        WHERE doctors.id = :id)");
        $pacientsNamesStmt->execute(array(
            ':id' => $rowDoctor['id'],
        ));
  
        if (isset($_POST['addPatients'])) {
            
            if ($_POST['PatientName']!==''){
                $pacientsNamesStmt = $db->prepare("INSERT INTO `patients-doctor`(`doctor_id`, `patient_id`) VALUES  (:doctor_id, :patient_id)");
                $pacientsNamesStmt->execute(array(
                    ':doctor_id' => $rowDoctor['id'],
                    ':patient_id' => $_POST['PatientName']
                ));
                $succes = 'Pacient add.';
                header("Location: pacients-view.php?id={$rowDoctor['id']}&error={$succes}");
                exit;
            }else{
                $error[] = 'Please enter the patient ame.';
            }
        }
        if (isset($error)) {
            foreach ($error as $error) {
              echo '<p class=" rounded w-25 h-2 p-1 border border-danger" style="border-width: 5px !important;" class="error"> ⚠️ ' . $error . '</p>';
            }
          }
        ?>



        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <img alt="Avatar" class="md-avatar rounded-circle" src="<?= $rowDoctor['image'] ?>" width="50" height="50" />
                            <?= $rowDoctor['name'] ?>
                        </div>
                        <div class="col-md-3">
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class="input-group">
                                <select class="form-control select2bs4" name='PatientName' ">
                                <?php while ($names = $pacientsNamesStmt->fetch()) { ?>
                                    <option value="<?= $names['id'] ?>"><?= $names['name'] ?></option>
                                <?php } ?>
                                </select>
                                <span class="input-group-append">
                                    <button type="submit" name="addPatients" class="btn btn-outline-success"><i class="fas fa-user-plus"></i>Add patient</button>
                                </span>
                            </div>
                        </form>   
                        </div>
                        <div class="col-md-1">
                            <div class="card-tools float-sm-right">

                                <a class="btn btn-outline-danger " href="doctors.php"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">=#=</th>
                        <th style="width: 15%">= Name =</th>
                        <th style="width: 40%">= Health Condition =</th>
                        <th style="width: 2%">= Phone =</th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <!-- заполнение таблицы -->
                <?php while ($row = $stmt->fetch()) { ?>
                    <tbody>
                        <tr>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="<?= $row['image'] ?>">
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <a><?= $row['name'] ?></a>
                                <br />
                                <?php if ($row['gender'] == 1) { ?>
                                    <span class="badge bg-primary">Man</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning">Woman</span>
                                <?php  } ?>
                                <br />
                                <small>Created <?= date('M Y H:i', strtotime($row['created'])) ?></small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <a><?= $row['health_condition'] ?></a>
                                </ul>
                            </td>

                            <td>
                                <ul class="list-inline">
                                    <a><?= $row['phone'] ?></a>
                                </ul>
                            </td>

                            <td class="project-actions text-right">

                                <a class="btn btn-info btn-sm" href="">
                                    <i class="fas fa-pencil-alt"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="patientsDoctorsDelete.php?patient_id=<?=$row['id']?>&id=<?=$rowDoctor['id']?> ">
                                    <i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
            </table>
    </div>

    </section>
    <!-- ./wrapper -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>