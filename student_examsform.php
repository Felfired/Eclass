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
                                    <h3 class="mt-4"> Φόρμα Δήλωσης Μαθημάτων </h3>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="student.php"> Αρχική Σελίδα </a> </li> 
                                        <li class="breadcrumb-item"> <a href="student_startexams.php">  Δήλωση Μαθημάτων </a> </li>
                                        <li class="breadcrumb-item active">  Φόρμα Δήλωσης Μαθημάτων </li>
                                    </ol>
                                    <?php  
                                        if($_SESSION['isFinal']==0)
                                        {?>
                                        
                                            <div class="row mt-1 justify-content-center">
                                                <div class="col-lg-9">
                                                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                                        <div class="card-header">
                                                            <h3 class="text-center font-weight-normal my-2"> Δήλωση Μαθημάτων </h3>
                                                        </div>
                                                        <div class="card-body justify-content-center">
                                                            <form id="exams_form" method="post">
                                                                <div class="form-row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="LessonName"> Τίτλος Μαθήματος </label>
                                                                            <select class="form-control" name = "course_name[]" multiple>
                                                                                <?php
                                                                                    $query1 = "SELECT Lesson FROM teaching";
                                                                                    $result1 = mysqli_query($conn, $query1);
                                                                                    while($row1 = mysqli_fetch_array($result1))
                                                                                    {
                                                                                        echo '<option value="'. $row1['Lesson'] . '">' . $row1['Lesson'] . '</option>';
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                            <input type="submit" class="btn btn-primary btn-block" name ="cur_submit" value="Προσωρινή Υποβολή">
                                                                            <input type="submit" class="btn btn-primary btn-block" name ="submit" value="Οριστική Υποβολή">
                                                                            <?php
                                                                                $ID_Student = $_SESSION['Username'];
                                                                                if(isset($_POST['cur_submit'])){
                                                                                    $delete = "DELETE FROM student_exams WHERE ID_Student = '$ID_Student'";
                                                                                    mysqli_query($conn, $delete);
                                                                                    if(isset($_POST["course_name"])){ 
                                                                                        foreach ($_POST['course_name'] as $course_name)  {
                                                                                            $q = "SELECT ID FROM course WHERE Name = '$course_name'";
                                                                                            $r = mysqli_query($conn, $q);
                                                                                            $req = mysqli_fetch_assoc($r)["ID"];
                                                                                            $submition = "INSERT INTO student_exams (ID_Student ,  ID_Course )
                                                                                            VALUES ('$ID_Student','$req')";
                                                                                            mysqli_query($conn, $submition);
                                                                                        }
                                                                                    }
                                                                                    echo '<script type="text/javascript">';
                                                                                    echo 'window.location.href="student.php"';
                                                                                    echo '</script>'; 
                                                                                }
                                                                                if(isset($_POST['submit'])){
                                                                                    $delete = "DELETE FROM student_exams WHERE ID_Student = '$ID_Student'";
                                                                                    mysqli_query($conn, $delete);
                                                                                    if(isset($_POST["course_name"])){ 
                                                                                        foreach ($_POST['course_name'] as $course_name)  {
                                                                                            $q = "SELECT ID FROM course WHERE Name = '$course_name'";
                                                                                            $r = mysqli_query($conn, $q);
                                                                                            $req = mysqli_fetch_assoc($r)["ID"];
                                                                                            $submition = "INSERT INTO student_exams (ID_Student ,  ID_Course )
                                                                                            VALUES ('$ID_Student','$req')";
                                                                                            mysqli_query($conn, $submition);
                                                                                        }
                                                                                    }
                                                                                    $is_final = "UPDATE exams_final SET isFinal = 1 WHERE ID_Login = '$ID_Student' ";
                                                                                    mysqli_query($conn, $is_final);
                                                                                    echo '<script type="text/javascript">';
                                                                                    echo 'window.location.href="student.php"';
                                                                                    echo '</script>'; 
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
                                        <?php }
                                        else{ ?>
                                            <div class="alert alert-info mt-3" role="alert">
                                                Έχετε υποβάλλει οριστική αίτηση και δεν μπορείτε να κάνετε νέα.
                                            </div>
                                            <div class="row mt-1 justify-content-center">
                                                <div class="col-xl-12">
                                                    <div class="card mb-4 mt-5" id="courses_card">
                                                        <div class="card-header">
                                                            <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Τελική Δήλωση   
                                                        </div>
                                                         <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed; width: 100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Όνομα</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $query1 = "SELECT ID_Course FROM student_exams";
                                                                    $result1 = mysqli_query($conn, $query1); 
                                                                    while($row = mysqli_fetch_array($result1))
                                                                    {
                                                                        ?>
                                                                    <tr>
                                                                        <td style="word-wrap: break-word" > <?php
                                                                            $ID = $row['ID_Course'];
                                                                            $sql1 = "SELECT Name FROM course WHERE ID = '$ID'";
                                                                            $result1 = mysqli_query($conn , $sql1);
                                                                            $Name = mysqli_fetch_assoc($result1)['Name'];
                                                                            echo $Name;
                                                                         ?> </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                       <?php }
                                    ?>
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