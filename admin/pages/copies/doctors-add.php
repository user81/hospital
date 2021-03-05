<?php



require_once('../../includes/config.php'); ?>
<?php require('PHPpageScripts/arreyErrorMesage.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Doctors</title>

  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">

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
      <?php
        if (isset($_POST['submit'])) {
          $errors = [];$error = [];
          $fileError = [];
          $errors = arrayInputErrors($_POST);
          $fileError = filesErrors($_FILES, $_POST);
          $error =array_merge($errors,$fileError);
         
          if (count($error)==0 ) {
            $stmt = $db->prepare('INSERT INTO doctors (`image`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `workingStatus`, `created`) VALUES (:image, :name,:email,:password,:phone,:gender,:specialist,:workingStatus, :created)');
            $stmt->execute(array(
              ':image' => '../dist/img/doctors/'. $_FILES['DoctorImg']['name'],
              ':name' => $_POST['DoctorName'],
              ':email' => $_POST['DoctorEmail'],
              ':password' => $_POST['DoctorPassword'],
              ':phone' => $_POST['DoctorPhone'],
              ':gender' => $_POST['Gender'],
              ':specialist' => $_POST['Specialist'],
              ':workingStatus' => $_POST['WorkingStatus'],
              ':created' => date('Y-m-d H:i:s')
            ));
            $succes = 'Doctor add.';
            header("Location: doctors.php?error={$succes}");
            exit;
          }
        }
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<p class=" rounded w-25 h-2 p-1 border border-danger" style="border-width: 5px !important;" class="error"> ⚠️ ' . $error . '</p>';
          }
        }
        ?>
        <div class="container-fluid">
          <div class="card card-default">

            <!-- /.card-header -->
            <form action='' method='post' enctype='multipart/form-data'>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Add avatar</label>
                      <div class="form-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="InputDoctorImg" aria-describedby="InputDoctorImg" name='DoctorImg' value=''>
                          <label class="custom-file-label" for="InputDoctorImg"><i class="fas fa-photo-video"></i> Choose image </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Doctors name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user-nurse"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Popov A.A." inputmode="text" name='DoctorName' value=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Doctors email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Enter email" inputmode="text" name='DoctorEmail' value=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label></label>
                      <button type='submit' name='submit' value='Submit' class="btn btn-outline-primary">add</button>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Doctors password</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" inputmode="password" name='DoctorPassword' value=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Doctors phone</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name='DoctorPhone' value=''>
                      </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Ppecialists</label>
                      <select class="form-control select2bs4" name='Specialist' style="width: 100%; ">
                        <option selected="selected">Family physicians</option>
                        <option>Internists</option>
                        <option>Pediatricians</option>
                        <option>Tennessee</option>
                        <option>Psychiatrists</option>
                        <option>Surgeons</option>
                        <option>Anesthesiologists</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- radio -->
                        <label for="radioGender"></label>
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioMan" name="Gender" value="1" checked="">
                            <label for="radioMan"> MAN
                            </label>
                          </div>
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioWoman" name="Gender" value="0">
                            <label for="radioWoman"> WOMAN
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <!-- radio -->
                        <label for="radioWorkingStatus"></label>
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="work" name="WorkingStatus" value="1" checked="">
                            <label for="work"> WORK
                            </label>
                          </div>
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="Notwork" name="WorkingStatus" value="0">
                            <label for="Notwork"> NOT WORK</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- ./wrapper -->
  <script>
    /* show file value after file select */
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      var fileName = document.getElementById("InputDoctorImg").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = fileName
    })



    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    
  </script>

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- dropzonejs -->
  <script src="../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>

  <!-- Page specific script -->


  <script>
    $(function() {
      //Money Euro
      $('[data-mask]').inputmask()
    })

    // DropzoneJS Demo Code End
  </script>

</body>

</html>