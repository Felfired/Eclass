<?php 
    session_start();
    include 'includes/connect.php';
    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else if($_SESSION['Type'] == 1) 
    { 
        $oldid = $_GET['id'];
        $sql = "SELECT Name , Description FROM course WHERE ID = '$oldid'";
        $result = mysqli_query($conn , $sql);
        $courses_result = mysqli_fetch_assoc($result);
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
                                    <h3 class="mt-4 mb-3"> Επεξεργασία Στοιχείων Μαθήματος </h1>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="admin.php"> Αρχική Σελίδα </a> </li>
                                        <li class="breadcrumb-item"> <a href="admin_courses.php"> Μαθήματα </a> </li>  
                                        <li class="breadcrumb-item active"> Επεξεργασία Στοιχείων Μαθήματος </li>
                                    </ol>
                                    <!--Start Of Dynamic Course Form-->
                                     <div class="container-fluid"  id="dynamic_row"> 
                                            <div class="row mt-1 justify-content-center">
                                                <div class="col-lg-9">
                                                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                                        <div class="card-header">
                                                            <h3 class="text-center font-weight-normal my-2"> Τροποποίηση Μαθήματος </h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form id="student_form" method="post">
                                                                <div class="form-row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="LessonName"> Τίτλος Μαθήματος </label>
                                                                            <input class="form-control py-3" id="inputLessonName" type="text" placeholder="" value = "<?php echo $courses_result['Name']?>" name="inputLessonName"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="ID"> Αναγνωριστικό Μαθήματος </label>
                                                                            <input class="form-control py-3" id="inputID" type="text" value = "<?php echo $oldid?>" placeholder="" name="inputID"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="inputDescription"> Περιγραφή </label>
                                                                            <input class="form-control py-3" id="inputDescription" type="text" value = "<?php echo $courses_result['Description']?>" placeholder="" name="inputDescription"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="inputReq"> Προαπαιτούμενα Μαθήματα (Προαιρετικό) </label>
                                                                            <select class="form-control mt-0 input-large" name="inputReq[]" multiple>
                                                                                <option disabled selected>--[Ctrl] για πολλαπλή επιλογή--</option>
                                                                                <?php
                                                                                $query1 = "SELECT * FROM course";
                                                                                $result1 = mysqli_query($conn, $query1);
                                                                                while($row1 = mysqli_fetch_array($result1))
                                                                                {
                                                                                    echo '<option value="'. $row1['Name'] . '">' . $row1['Name']. '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>      
                                                                <div class="form-row justify-content-center">
                                                                    <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <a href="admin_courses.php" style="text-decoration: none;"> <input type="button" class="btn btn-danger btn-block"  value="Ακύρωση"> </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <input type="submit" class="btn btn-primary btn-block" name = "submit" value="Υποβολή">
                                                                                <?php 
                                                                                if(isset($_POST['submit'])){
                                                                                    $name  = $_POST['inputLessonName'];
                                                                                    $description = $_POST['inputDescription'];
                                                                                    $ID = $_POST['inputID'];
                                                                                    if(isset($_POST["inputReq"])){ 
                                                                                        $delete = "DELETE FROM course_req WHERE ID_Course= '$id'";
                                                                                        mysqli_query($conn , $delete);
                                                                                        foreach ($_POST['inputReq'] as $inputReq)  {
                                                                                            $q = "SELECT ID FROM course WHERE Name = '$inputReq'";
                                                                                            $r = mysqli_query($conn, $q);
                                                                                            $req = mysqli_fetch_assoc($r)["ID"];
                                                                                            $new = "INSERT INTO course_req ( ID_Course , ID_Req ) 
                                                                                            VALUES ('$id', '$req')";
                                                                                            mysqli_query($conn, $new);
                                                                                        }
                                                                                    }
                                                                                    $sql1 = "UPDATE course_req SET ID_Course = '$ID' WHERE ID_Course = '$oldid'";
                                                                                    $sql =  "UPDATE course SET Name = '$name' , Description = '$description', ID = '$ID' WHERE ID = '$oldid'";
                                                                                    $sql2 = "UPDATE course_req SET ID_Req = '$ID' WHERE ID_Req = '$oldid'";
                                                                                    $sql3 = "UPDATE professor_course SET ID_Course = '$ID' WHERE ID_Course = '$oldid'";
                                                                                    $sql4 = "UPDATE student_course SET ID_Course = '$ID' WHERE ID_Course = '$oldid'";
                                                                                    $sql5 = "UPDATE student_exams SET ID_Course = '$ID' WHERE ID_Course = '$oldid'";
                                                                                    $sql6 = "UPDATE teaching SET ID = '$ID' WHERE ID = '$oldid'";
                                                                                    mysqli_query($conn , $sql1);
                                                                                    mysqli_query($conn , $sql);
                                                                                    mysqli_query($conn , $sql2);
                                                                                    mysqli_query($conn , $sql3);
                                                                                    mysqli_query($conn , $sql4);
                                                                                    mysqli_query($conn , $sql5);
                                                                                    mysqli_query($conn , $sql6);

                                                                                    echo '<script type="text/javascript">';
                                                                                    echo 'window.location.href="admin_courses.php";';
                                                                                    echo '</script>';
                                                                                }
                                                                    ?>
                                                                            </div>
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