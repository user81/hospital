<!-- Content Header (Page header) -->
<section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?php 
                                $pieces[] = explode(".", basename($_SERVER['PHP_SELF']) );
                               print_r($pieces[0][0]);
                                ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="doctors.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>