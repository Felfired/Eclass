<?php 
    session_start();
    include 'includes/connect.php';
    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else if($_SESSION['Type'] == 1) 
    {   
        $id =$_GET['id'];
        $sql = "SELECT * FROM professor WHERE Login='$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) 
        {
            $name = $row['Name'];
            $surname = $row['Surname'];
            $spec = $row['Spec'];
        }

         ?>
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
                                <div class="container-fluid">
                                    <h3 class="mt-4 mb-3"> Επεξεργασία Στοιχείων Φοιτητή </h1>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="admin.php"> Αρχική Σελίδα </a> </li>
                                        <li class="breadcrumb-item"> <a href="admin_prprefs.php"> Ρυθμίσεις Χρηστών </a> </li>  
                                        <li class="breadcrumb-item active"> Επεξεργασία Στοιχείων Προσωπικού </li>
                                    </ol>
                                    <!--Dynamic Professor Container-->
                        <div id="dynamic-centered-row-2">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                            <div class="card-header">
                                                <h3 class="text-center font-weight-normal my-2"> Επεξεργασία Στοιχείων </h3> 
                                            </div>
                                            <div class="card-body">
                                                <form id="student_form" method="post" onsubmit="return passwdValidate()">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputFirstName"> Όνομα </label>
                                                                <input class="form-control py-3" id="inputFirstName" type="text" value="<?php echo $name?>" name="inputFirstName"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputLastName"> Επώνυμο </label>
                                                                <input class="form-control py-3" id="inputLastName" type="text" value="<?php echo $surname?>" name="inputLastName"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputUsername"> Αναγνωριστικό </label>
                                                                <input class="form-control py-3" id="inputUsername" type="text" value="<?php echo $id?>" name="inputUsername">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label class="small mb-1" for="inputSpec"> Ειδικότητα </label>
                                                                    <select class="form-control mt-0 input-large" name="inputSpec">
                                                                        <option <?php echo $spec?> selected> <?php echo $spec?> </option>
                                                                        <option value="Αναπληρωτής"> Αναπληρωτής </option>
                                                                        <option value="Επίκουρος"> Επίκουρος </option>
                                                                        <option value="Καθηγητής"> Καθηγητής </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputPassword"> Κωδικός </label>
                                                                <input class="form-control py-3" id="inputPassword" type="password"  name="inputPassword"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputrePassword"> Επανάληψη Κωδικού </label>
                                                                <input class="form-control py-3" id="inputrePassword" type="password"  name="inputrePassword"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-4 mb-0">
                                                        <input type="submit" class="btn btn-primary btn-block" name = "submit" value="Υποβολή"> 
                                                        <?php 
                                                                        if(isset($_POST['submit'])){
                                                                            $name  = $_POST['inputFirstName'];
                                                                            $surname = $_POST['inputLastName'];
                                                                            $spec = $_POST['inputSpec'];
                                                                            $login = $_POST['inputUsername'];
                                                                            $password = $_POST['inputPassword'];
                                                                            $hash =  password_hash($password, PASSWORD_DEFAULT);
                                                                            $sql =  "UPDATE professor SET Name = '$name' , Surname = '$surname', Spec = '$spec' , Login = '$login' WHERE Login = '$id'";
                                                                            $sql1 = "UPDATE user SET Login = '$login', Passwd = '$hash' WHERE Login = '$id'";
                                                                            $sql2 = "UPDATE teaching SET Professor = '$login' WHERE Professor = '$id'";
                                                                            $sql3 = "UPDATE professor_course SET ID_Professor = '$login' WHERE ID_Professor =  '$id'";
                                                                            mysqli_query($conn , $sql);
                                                                            mysqli_query($conn , $sql1);
                                                                            mysqli_query($conn , $sql2);
                                                                            mysqli_query($conn , $sql3);
                                                                            echo '<script type="text/javascript">';
                                                                            echo 'window.location.href="admin_prprefs.php";';
                                                                            echo '</script>';
                                                                        }
                                                                    ?>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer text-center">
                                                <div class="small">
                                                    <a href="admin_prprefs.php"> Επιστροφή </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End of Dynamic Professor Container--> 
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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                    <script src="assets/demo/datatables-demo.js"></script>
                </body>
            </html>
        <?php } 
?>