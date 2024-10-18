<?php 
        session_start();
        include 'includes/connect.php';
        if (isset($_SESSION['Type']) == false)
        {
            header("Location: index.php");
        }
        else if($_SESSION['Type'] == 3) 
        {
            $ID_Lesson = $_GET['id'];

            $Lab_Th1 = "SELECT Theory FROM teaching WHERE ID = '$ID_Lesson'";
            $Result1 = mysqli_query($conn , $Lab_Th1);
            $Result_Theory = mysqli_fetch_assoc ($Result1)['Theory'];

            $Lab_Th2 = "SELECT Lab FROM teaching WHERE ID = '$ID_Lesson'";
            $Result2 = mysqli_query($conn , $Lab_Th2);
            $Result_Lab = mysqli_fetch_assoc ($Result2)['Lab'];

            $Lab_Th3 = "SELECT TheoryLength FROM teaching WHERE ID = '$ID_Lesson'";
            $Result3 = mysqli_query($conn , $Lab_Th3);
            $Result_TheoryLength = mysqli_fetch_assoc ($Result3)['TheoryLength'];

            $Lab_Th4 = "SELECT LabLength FROM teaching WHERE ID = '$ID_Lesson'";
            $Result4 = mysqli_query($conn , $Lab_Th4);
            $Result_LabLength = mysqli_fetch_assoc ($Result4)['LabLength'];
            ?>
            <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="utf-8" />
                        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
                        <meta name="description" content="" />
                        <meta name="author" content="" />
                        <title>Eclass</title>
                        <link href="css/styles.css" rel="stylesheet"/>
                        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous"/>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
                    </head>
                    <body class="sb-nav-fixed">
                        <!-- Navbar-->
                        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                            <a class="navbar-brand visible-lg-block" href="admin.php">
                                <img src="assets/img/logo-nav.png" width="30" height="30" class="d-inline-block align-top" alt="">
                                ICSD - Eclass
                            </a>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="includes/logout.php"> Αποσύνδεση </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <div id="layoutSidenav">
                            <div id="layoutSidenav_nav">
                                <?php
                                    include("menu.php");
                                ?>
                            </div>
                            <div id="layoutSidenav_content">
                                <main>
                                    <div class="container-fluid" id="dynamic_row"> 
                                        <h3 class="mt-4 mb-3">Μαθήματα</h1>
                                        <ol class="breadcrumb mb-2">
                                            <li class="breadcrumb-item"> <a href="professor.php"> Αρχική Σελίδα </a> </li>
                                            <li class="breadcrumb-item"> <a href="professor_grading.php"> Βαθμολογίες </a> </li> 
                                            <li class="breadcrumb-item active"> Ανανέωση Τρόπου Βαθμολόγησης </li>
                                        </ol>
                                        <div class="row mt-1 justify-content-center">
                                            <div class="col-lg-9">
                                                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                                    <div class="card-header">
                                                        <h3 class="text-center font-weight-normal my-2"> Ανανέωση Τρόπου Βαθμολόγησης </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="student_form" method="post">  
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="small mb-1" for="inputLab"> Βάρος Εργαστηρίου </label>
                                                                        <input class="form-control py-3" id="inputLab" type="number" step="0.1" value="<?php echo $Result_Lab?>" name="inputLab" required/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="small mb-1" for="inputTheory"> Βάρος Θεωρίας </label>
                                                                        <input class="form-control py-3" id="inputTheory" type="number" step="0.1" value="<?php echo $Result_Theory?>" name="inputTheory" required/>
                                                                    </div>
                                                                </div>
                                                            </div>   
                                                            <div class="form-row"> 
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="small mb-1" for="inputLab1"> Περιορισμός Εργαστηρίου </label>
                                                                        <input class="form-control py-3" id="inputLab1" type="number" value="<?php echo $Result_LabLength?>" name="inputLab1" required/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="small mb-1" for="inputTheory1"> Περιορισμός Θεωρίας </label>
                                                                        <input class="form-control py-3" id="inputTheory1" type="number" value="<?php echo $Result_TheoryLength?>" name="inputTheory1" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        <div class="form-group">
                                                                            <a href="professor_grading.php" style="text-decoration: none;"> <input type="button" class="btn btn-danger btn-block"  value="Ακύρωση"> </a>
                                                                        </div>
                                                                    </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-primary btn-block" name ="submit" value="Υποβολή">
                                                                    </div>
                                                                            <?php
                                                                                if(isset($_POST['submit']))
                                                                                {
                                                                                    $inputTheory =  $_POST['inputTheory'];
                                                                                    $inputLab = $_POST['inputLab'];
                                                                                    $inputTheory1 = $_POST['inputTheory1'];
                                                                                    $inputLab1 = $_POST['inputLab1'];
                                                                                    $Update = "UPDATE teaching SET Theory = $inputTheory, Lab = $inputLab, TheoryLength = $inputTheory1 , LabLength = $inputLab1 WHERE ID = '$ID_Lesson' ";
                                                                                    mysqli_query($conn , $Update);
                                                                                    echo '<script type="text/javascript">';
                                                                                    echo 'window.location.href="professor_grading.php";';
                                                                                    echo '</script>';
                                                                                }

                                                                            ?>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                                <footer class="py-4 bg-light mt-auto">
                                    <div class="container-fluid">
                                        <div class="d-flex align-items-center justify-content-between small">
                                            <div class="text-muted">Copyright &copy; Πανεπιστήμιο Αιγαίου 2021</div>
                                            <div>
                                                <a href="#">Πολιτική Προστασίας</a>
                                                &middot;
                                                <a href="#">Όροι &amp; Προϋποθέσεις</a>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                        <script src="js/scripts.js"></script>
                        <script src="js/custom.js"></script>
                        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                        <script src="assets/demo/datatables-demo.js"></script>
                    </body>
                </html>
        <?php }
        else if($_SESSION['Type'] == 1)
        {
            $ID_Lesson = $_GET['id'];

            $Lab_Th1 = "SELECT Theory FROM teaching WHERE ID = '$ID_Lesson'";
            $Result1 = mysqli_query($conn , $Lab_Th1);
            $Result_Theory = mysqli_fetch_assoc ($Result1)['Theory'];

            $Lab_Th2 = "SELECT Lab FROM teaching WHERE ID = '$ID_Lesson'";
            $Result2 = mysqli_query($conn , $Lab_Th2);
            $Result_Lab = mysqli_fetch_assoc ($Result2)['Lab'];

            $Lab_Th3 = "SELECT TheoryLength FROM teaching WHERE ID = '$ID_Lesson'";
            $Result3 = mysqli_query($conn , $Lab_Th3);
            $Result_TheoryLength = mysqli_fetch_assoc ($Result3)['TheoryLength'];

            $Lab_Th4 = "SELECT LabLength FROM teaching WHERE ID = '$ID_Lesson'";
            $Result4 = mysqli_query($conn , $Lab_Th4);
            $Result_LabLength = mysqli_fetch_assoc ($Result4)['LabLength'];
        ?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Eclass</title>
            <link href="css/styles.css" rel="stylesheet"/>
            <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous"/>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        </head>
        <body class="sb-nav-fixed">
            <!-- Navbar-->
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                <a class="navbar-brand visible-lg-block" href="admin.php">
                    <img src="assets/img/logo-nav.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    ICSD - Eclass
                </a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="includes/logout.php"> Αποσύνδεση </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <?php
                        include("menu.php");
                    ?>
                </div>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid" id="dynamic_row"> 
                            <h3 class="mt-4 mb-3">Μαθήματα</h1>
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item"> <a href="professor.php"> Αρχική Σελίδα </a> </li>
                                <li class="breadcrumb-item"> <a href="professor_grading.php"> Βαθμολογίες </a> </li> 
                                <li class="breadcrumb-item active"> Ανανέωση Τρόπου Βαθμολόγησης </li>
                            </ol>
                            <div class="row mt-1 justify-content-center">
                                <div class="col-lg-9">
                                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                        <div class="card-header">
                                            <h3 class="text-center font-weight-normal my-2"> Ανανέωση Τρόπου Βαθμολόγησης </h3>
                                        </div>
                                        <div class="card-body">
                                            <form id="student_form" method="post">  
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputLab"> Βάρος Εργαστηρίου </label>
                                                            <input class="form-control py-3" id="inputLab" type="number" step="0.1" value="<?php echo $Result_Lab?>" name="inputLab" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputTheory"> Βάρος Θεωρίας </label>
                                                            <input class="form-control py-3" id="inputTheory" type="number" step="0.1" value="<?php echo $Result_Theory?>" name="inputTheory" required/>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="form-row"> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputLab1"> Περιορισμός Εργαστηρίου </label>
                                                            <input class="form-control py-3" id="inputLab1" type="number" value="<?php echo $Result_LabLength?>" name="inputLab1" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputTheory1"> Περιορισμός Θεωρίας </label>
                                                            <input class="form-control py-3" id="inputTheory1" type="number" value="<?php echo $Result_TheoryLength?>" name="inputTheory1" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                            <div class="form-group">
                                                                <a href="professor_grading.php" style="text-decoration: none;"> <input type="button" class="btn btn-danger btn-block"  value="Ακύρωση"> </a>
                                                            </div>
                                                        </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-primary btn-block" name ="submit" value="Υποβολή">
                                                        </div>
                                                                <?php
                                                                    if(isset($_POST['submit']))
                                                                    {
                                                                        $inputTheory =  $_POST['inputTheory'];
                                                                        $inputLab = $_POST['inputLab'];
                                                                        $inputTheory1 = $_POST['inputTheory1'];
                                                                        $inputLab1 = $_POST['inputLab1'];
                                                                        $Update = "UPDATE teaching SET Theory = $inputTheory, Lab = $inputLab, TheoryLength = $inputTheory1 , LabLength = $inputLab1 WHERE ID = '$ID_Lesson' ";
                                                                        mysqli_query($conn , $Update);
                                                                        echo '<script type="text/javascript">';
                                                                        echo 'window.location.href="professor_grading.php";';
                                                                        echo '</script>';
                                                                    }

                                                                ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Πανεπιστήμιο Αιγαίου 2021</div>
                                <div>
                                    <a href="#">Πολιτική Προστασίας</a>
                                    &middot;
                                    <a href="#">Όροι &amp; Προϋποθέσεις</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="js/custom.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
            <script src="assets/demo/datatables-demo.js"></script>
        </body>
    </html>

        <?php }
    ?>