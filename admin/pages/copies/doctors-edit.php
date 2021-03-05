<?php require_once('../../includes/config.php'); ?>
<?php require_once('PHPpageScripts/arreyErrorMesage.php'); ?>
<?php require_once('PHPpageScripts/idExists.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Doctors edit</title>

  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
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
  <?php
  $row = DoctorIdExists($_GET['id'], $db);
  
  $arrayPatUrl=explode("/", $row['image']);
  $rowImageName = end($arrayPatUrl);
 
  if (isset($_POST['submit'])) {
    // arrayErrors выводит ошибки и тамже загрузка файла
    $error = [];
    $fileError = [];  
    $error = arrayInputErrors($_POST);
    $fileError = filesErrors($_FILES, $_POST);
      if (count($fileError)) {
        if (file_exists($row['image']) && $rowImageName!='') {
          $imageName =  $rowImageName;
        } else {
          $error[] = 'Please enter the image.';
        }
      }else { 
        $imageName=$_FILES['DoctorImg']['name'];
      }
    
    
    if (count($error) == 0 && $imageName!='') {
      $stmt = $db->prepare('UPDATE doctors SET image = :image, name = :name, email = :email, password = :password, phone = :phone, gender = :gender, specialist = :specialist, workingStatus = :workingStatus  WHERE id = :id');
      $stmt->execute(array(
        ':id' => $row['id'],
        ':image' => '../dist/img/doctors/' .$imageName,
        ':name' => $_POST['DoctorName'],
        ':email' => $_POST['DoctorEmail'],
        ':password' => $_POST['DoctorPassword'],
        ':phone' => $_POST['DoctorPhone'],
        ':gender' => $_POST['Gender'],
        ':specialist' => $_POST['Specialist'],
        ':workingStatus' => $_POST['WorkingStatus']
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
  <!-- realpath(dirname(__FILE__).'/'.'../dist/img/doctors/avatar5.png')  -->
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
                          <input type="file" class="custom-file-input" id="InputDoctorImg" aria-describedby="InputDoctorImg" name='DoctorImg' value=<?= realpath(dirname(__FILE__) . '/' . '../dist/img/doctors/avatar5.png') ?>>
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
                        <input type="text" class="form-control" placeholder="Popov A.A." inputmode="text" name='DoctorName' value='<?= $row['name'] ?>'>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Doctors email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Enter email" inputmode="text" name='DoctorEmail' value=<?= $row['email'] ?>>
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
                        <input type="password" class="form-control" placeholder="Password" inputmode="password" name='DoctorPassword' value=<?= $row['password'] ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Doctors phone</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name='DoctorPhone' value="<?= $row['phone'] ?>">
                      </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Ppecialists</label>
                      <select class="form-control select2bs4" name='Specialist' style="width: 100%; ">
                        <option value="Family physicians" selected="selected">Family physicians</option>
                        <option value="Internists">Internists</option>
                        <option value="Pediatricians">Pediatricians</option>
                        <option value="Tennessee">Tennessee</option>
                        <option value="Psychiatrists">Psychiatrists</option>
                        <option value="Surgeons">Surgeons</option>
                        <option value="Anesthesiologists">Anesthesiologists</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- radio -->
                        <label for="radioGender"></label>
                        <div class="form-group clearfix" id="Gender">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioMan" name="Gender" value="1">
                            <label for="radioMan"> MAN
                            </label>
                          </div>
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioWoman" name="Gender" value="0" checked>
                            <label for="radioWoman"> WOMAN
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <!-- radio -->
                        <label for="radioWorkingStatus"></label>
                        <div class="form-group clearfix" id="WorkingStatus">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="work" name="WorkingStatus" value="1">
                            <label for="work"> WORK
                            </label>
                          </div>
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="Notwork" name="WorkingStatus" value="0" checked>
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
    //
    document.querySelector(".select2bs4 > option[selected]").removeAttribute("selected");
    document.querySelector(".select2bs4 > option[value=<?= $row['specialist'] ?>]").setAttribute("selected", "selected");


    document.querySelector('#Gender>.icheck-primary  > input[value="<?= $row['gender'] ?>"]').setAttribute('checked', true);
    document.querySelector('#WorkingStatus>.icheck-primary  >input[value="<?= $row['workingStatus'] ?>"]').setAttribute('checked', true);
  </script>
  <script>
    /* show file value after file select */
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      var fileName = document.getElementById("InputDoctorImg").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = fileName
    })
  </script>


  <script>
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  </script>

  <script>
    $(function() {
      //Money Euro
      $('[data-mask]').inputmask()
    })

    // DropzoneJS Demo Code End
  </script>

</body>

</html>