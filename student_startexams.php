<?php
    session_start();
    include 'includes/connect.php';
    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else  if($_SESSION['Type'] == 2)
    { ?>
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
                    <meta name="description" content="" />
                    <meta name="author" content="" />
                    <title> Eclass </title>
                    <link href="/Eclass Project/css/styles.css" rel="stylesheet"/>
                    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous"/>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
                </head>
                <body class="sb-nav-fixed">
                    <!-- Navbar-->
                    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                        <a class="navbar-brand visible-lg-block" href="student.php">
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
                                <div class="container-fluid">
                                    <h3 class="mt-4"> Δήλωση Μαθημάτων </h3>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="student.php"> Αρχική Σελίδα </a> </li> 
                                        <li class="breadcrumb-item active"> Δήλωση Μαθημάτων </li>
                                    </ol>
                                    <div class="dynamic-row-container" id="dynamic_row"> 
                                        <div class="row mt-1 justify-content-center">
                                            <div class="col-xl-9">
                                                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                                    <div class="card-header">
                                                        <h3 class="text-center font-weight-normal my-2"> Δημιουργία Νέας Δήλωσης </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="student_form" method="post">
                                                            <div class="form-row justify-content-center">
                                                                <div class="col-lg-10">
                                                                    <div class="form-group">
                                                                        <label class="med mb-1" for="LessonName"> Θέλετε να ξεκινήσετε μια νέα δήλωση μαθημάτων; </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row justify-content-center">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <a href="student.php" style="text-decoration: none;"> <input type="button" class="btn btn-danger btn-block"  value="Ακύρωση"> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-primary btn-block" name = "start_exams" value="Συνέχεια">
                                                                            <?php
                                                                                if(isset($_POST['start_exams']))
                                                                                {   
                                                                                    $ID_Login = $_SESSION['Username'];
                                                                                    $does_exist = "SELECT isFinal FROM exams_final WHERE ID_Login = '$ID_Login'";
                                                                                    $query = mysqli_query($conn, $does_exist);
                                                                                    if(mysqli_num_rows($query)==0)
                                                                                    {   
                                                                                        $sql = "INSERT INTO exams_final (ID_Login, isFinal) VALUES ('$ID_Login', 0)";
                                                                                        mysqli_query($conn, $sql);
                                                                                        $_SESSION['isFinal'] = $isFinal;
                                                                                        echo '<script type="text/javascript">';
                                                                                        echo 'window.location.href="student_examsform.php";';
                                                                                        echo '</script>';
                                                                                    }
                                                                                    else if(mysqli_num_rows($query)==1)
                                                                                    {

                                                                                        $isFinal = mysqli_fetch_assoc($query)['isFinal'];
                                                                                        $_SESSION['isFinal'] = $isFinal;
                                                                                        if($isFinal == 0)
                                                                                        {
                                                                                            echo '<script type="text/javascript">';
                                                                                            echo 'window.location.href="student_examsform.php";';
                                                                                            echo '</script>';
                                                                                        }
                                                                                        else if($isFinal == 1){
                                                                                            echo '<script type="text/javascript">';
                                                                                            echo 'window.location.href="student_examsform.php";';
                                                                                            echo '</script>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                            <footer class="py-4 bg-light mt-auto">
                                <div class="container-fluid">
                                    <div class="d-flex align-items-center justify-content-between small">
                                        <div class="text-muted">Copyright &copy; icsd18129 icsd18009 icsd18069</div>
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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                    <script src="assets/demo/datatables-demo.js"></script>
                </body>
            </html>
        <?php } 
?>
