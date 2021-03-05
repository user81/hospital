<?php require_once('../../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
//DoctorIdExists редиретит на Doctors.php если пустая строка или такого шв нет
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
    <link rel="stylesheet" href="../dist/css/mycss/fullScreen.css">

    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">


</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('pageElements/navbar.php'); ?>
        <!-- Main Sidebar Container -->
        <?php require_once('pageElements/mainSidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php require_once('pageElements/contentHeder.php'); ?>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Doctors</h3>
                    </div>
                    <?php
                    if (isset($_GET['error'])) {
                        echo '<p class=" rounded w-25 h-2 p-1 border border-danger" style="border-width: 5px !important;" class="error"> ⚠️ ' . $_GET['error'] . '</p>';
                    }

                    ?>

                    <script language="JavaScript" type="text/javascript">
                        function delpost(id, title, type) {
                            if (type == 'Delete') {
                                if (confirm("Are you sure you want to delete '" + title + "'")) {
                                    window.location.href = 'doctors-delete.php?id=' + id;
                                }
                            } else if (type == 'Edit') {
                                if (confirm("Are you sure you want to edit '" + title + "'")) {
                                    window.location.href = 'doctors-edit.php?id=' + id;
                                }
                            } else if (type == 'View') {
                                if (confirm("Are you sure you want to view '" + title + "'")) {
                                    window.location.href = 'pacients-view.php?id=' + id;
                                }
                            }

                        }
                    </script>

                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">=#=</th>
                                    <th style="width: 15%">= Name/Date =</th>
                                    <th style="width: 20%">= Email/Password =</th>
                                    <th style="width: 10%">= Specialist/Phone =</th>
                                    <th>= Patients =</th>
                                    <th style="width: 20%"></th>
                                </tr>
                            </thead>


                            <?php
                            $stmt = $db->query("SELECT doctors.id, doctors.image,  doctors.name, doctors.email, doctors.password, doctors.phone,
                            doctors.gender, doctors.specialist, doctors.workingStatus, doctors.created,
                             COUNT(patients.id) AS count_patients 
                           FROM patients
                           INNER JOIN `patients-doctor` ON `patients-doctor`.patient_id = patients.id
                           INNER JOIN doctors ON `patients-doctor`.doctor_id = doctors.id
                           GROUP BY doctors.id 
                           UNION
                           select `id`, `image`, `name`, `email`, `password`, `phone`, `gender`,
                            `specialist`, `workingStatus`, `created`,'' from `doctors` 
                            where doctors.id not in (select doctor_id from `patients-doctor`)
                           ");
                            while ($row = $stmt->fetch()) { ?>

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

                                            <?php if ($row['workingStatus'] == 1) { ?>
                                                <span class="badge bg-success">work</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Not work</span>
                                            <?php  } ?>

                                            <br />
                                            <small>Created <?= date('M Y H:i', strtotime($row['created'])) ?></small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <a><?= $row['email'] ?></a>
                                                <br />
                                                <small><?= $row['password'] ?></small>
                                            </ul>
                                        </td>

                                        <td>
                                            <ul class="list-inline">
                                                <a><?= $row['phone'] ?></a>
                                                <br />
                                                <small><?= $row['specialist'] ?></small>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <?php
                                            if ($row['count_patients'] < 5) { ?>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width:<?= $row['count_patients'] * 25 ?>%"></div>

                                                </div>
                                            <?php } else { ?>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>

                                                </div>
                                            <?php } ?>


                                            <small> <?= $count = ($row['count_patients'] != '') ? $row['count_patients'] : 0;  ?> Patients </small>
                                        </td>

                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="javascript:delpost('<?= $row['id']; ?>','<?= $row['name']; ?>','View')">
                                                <i class="fas fa-folder"></i> View</a>
                                            <a class="btn btn-info btn-sm" href="javascript:delpost('<?= $row['id']; ?>','<?= $row['name']; ?>','Edit')">
                                                <i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" href="javascript:delpost('<?= $row['id']; ?>','<?= $row['name']; ?>','Delete')">
                                                <i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>