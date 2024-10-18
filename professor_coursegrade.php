<?php 
    session_start();
    include 'includes/connect.php';
    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else  if($_SESSION['Type'] == 3)
    { 
        $ID_Lesson = $_GET['id'];
        $Students = "SELECT * FROM student_exams WHERE ID_Course = '$ID_Lesson'";
        $Result_Students = mysqli_query($conn , $Students);
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
                        <a class="navbar-brand visible-lg-block" href="professor.php">
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
                                    <h3 class="mt-4"> Βαθμολογίες </h1>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="professor.php"> Αρχική Σελίδα </a> </li> 
                                        <li class="breadcrumb-item"> <a href="professor_grading.php"> Βαθμολογίες </a> </li>
                                        <li class="breadcrumb-item active"> Λίστα Φοιτητών </li>
                                    </ol>
                                    <div class="row mt-1 justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="card mb-4 mt-5" id="courses_card">
                                                <div class="card-header">
                                                    <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Λίστα Φοιτητών   
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed; width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Εισαγωγή Βαθμού</th>
                                                                    <th>Κωδικός Μαθήματος</th>
                                                                    <th>Κωδικός Φοιτητή</th>
                                                                    <th>Συνολική Βαθμολογία</th>
                                                                </tr>
                                                            </thead>
                                                <tbody>
                                                    <?php while($row = mysqli_fetch_array($Result_Students))
                                                    {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <a href="professor_insertgrade.php?id_s=<?php echo $row['ID_Student'] ?>&id_c=<?php echo $row['ID_Course'] ?>" style="text-decoration: none;"> <button type="button" class="btn btn-primary"><i class="fas fa-plus"> </i> </button> </a>
                                                            </td>
                                                            <td style="word-wrap: break-word" > <?php echo $row['ID_Course'] ?> </td>
                                                            <td style="word-wrap: break-word" id="<?php echo $row['ID_Student'] ?>"> <?php echo $row['ID_Student'] ?> </td>
                                                            <td style="word-wrap: break-word" id="<?php echo $row['ID_Student'] ?>">
                                                            <?php
                                                                $ID_Course = $row['ID_Course'];
                                                                $ID_Student = $row['ID_Student'];
                                                                $sql = "SELECT Grade FROM student_exams WHERE ID_Course = '$ID_Course' AND ID_Student = '$ID_Student'";
                                                                $result = mysqli_query($conn , $sql);
                                                                $Grade = mysqli_fetch_assoc($result)['Grade'];
                                                                if($Grade==NULL)echo "-";
                                                                else echo $Grade;
                                                            ?> </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $sql1 = "SELECT isFinal FROM student_exams WHERE ID_Course = '$ID_Lesson' ";
                                    $result1 = mysqli_query($conn , $sql1);
                                    $flag = 0;
                                    while($isFinal = mysqli_fetch_array($result1)['isFinal']){
                                        if($isFinal==1){
                                            $flag=1;
                                            break;
                                        }
                                    }
                                    if($flag==0){
                                    ?>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <a href="professor_confirmgrades.php?id=<?php echo $ID_Lesson ?>" style="text-decoration: none;">
                                                <button type="button" class="btn btn-success"> Οριστικοποίηση Βαθμολογίας </button> 
                                            </a>
                                        </div> 
                                    </div>
                                    <?php } ?>
                                    <div class="card mt-4">
                                        <div class="card-header">
                                                <i class="fas fa-file-csv text-center" style="margin-top:1%;"> </i> Χρήση Αρχείων   
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"> Εισαγωγή - Εξαγωγή Βαθμών </h5>
                                            <p class="card-text"> Υποστηρίζεται η χρήση αρχείων τύπου .csv για την εισαγωγή και την εξαγωγή βαθμών. </p>
                                            <a href="exportcsv.php?id=<?php echo $ID_Lesson ?>" class="btn btn-info"> Εξαγωγή CSV </a>
                                            <form action="importcsv.php" class="mt-1">
                                                <input type="submit" class="btn btn-info" value="Εισαγωγή CSV">
                                                <input type="hidden" name="ID_Course" value="<?php echo $ID_Lesson ?>">
                                                <input type="file" accept=".csv" id="myFile" name="filename" class="btn btn-info">
                                            </form>
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
        else if($_SESSION['Type'] == 1)
        {
            $ID_Lesson = $_GET['id'];
            $Students = "SELECT * FROM student_exams WHERE ID_Course = '$ID_Lesson'";
            $Result_Students = mysqli_query($conn , $Students);
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
                                    <h3 class="mt-4"> Βαθμολογίες </h1>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="professor.php"> Αρχική Σελίδα </a> </li> 
                                        <li class="breadcrumb-item"> <a href="professor_grading.php"> Βαθμολογίες </a> </li>
                                        <li class="breadcrumb-item active"> Λίστα Φοιτητών </li>
                                    </ol>
                                    <div class="row mt-1 justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="card mb-4 mt-5" id="courses_card">
                                                <div class="card-header">
                                                    <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Λίστα Φοιτητών   
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed; width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Εισαγωγή Βαθμού</th>
                                                                    <th>Κωδικός Μαθήματος</th>
                                                                    <th>Κωδικός Φοιτητή</th>
                                                                    <th>Συνολική Βαθμολογία</th>
                                                                </tr>
                                                            </thead>
                                                <tbody>
                                                    <?php while($row = mysqli_fetch_array($Result_Students))
                                                    {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <a href="professor_insertgrade.php?id_s=<?php echo $row['ID_Student'] ?>&id_c=<?php echo $row['ID_Course'] ?>" style="text-decoration: none;"> <button type="button" class="btn btn-primary"><i class="fas fa-plus"> </i> </button> </a>
                                                            </td>
                                                            <td style="word-wrap: break-word" > <?php echo $row['ID_Course'] ?> </td>
                                                            <td style="word-wrap: break-word" id="<?php echo $row['ID_Student'] ?>"> <?php echo $row['ID_Student'] ?> </td>
                                                            <td style="word-wrap: break-word" id="<?php echo $row['ID_Student'] ?>">
                                                            <?php
                                                                $ID_Course = $row['ID_Course'];
                                                                $ID_Student = $row['ID_Student'];
                                                                $sql = "SELECT Grade FROM student_exams WHERE ID_Course = '$ID_Course' AND ID_Student = '$ID_Student'";
                                                                $result = mysqli_query($conn , $sql);
                                                                $Grade = mysqli_fetch_assoc($result)['Grade'];
                                                                if($Grade==NULL)echo "-";
                                                                else echo $Grade;
                                                            ?> </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $sql1 = "SELECT isFinal FROM student_exams WHERE ID_Course = '$ID_Lesson' ";
                                    $result1 = mysqli_query($conn , $sql1);
                                    $flag = 0;
                                    $isFinal = mysqli_fetch_array($result1);
                                    if($isFinal!=NULL){
                                        while($final = $isFinal['isFinal']){
                                            if($final==1){
                                                $flag=1;
                                                break;
                                            }
                                        }
                                    }
                                    
                                    if($flag==0){
                                    ?>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <a href="professor_confirmgrades.php?id=<?php echo $ID_Lesson ?>" style="text-decoration: none;">
                                                <button type="button" class="btn btn-success"> Οριστικοποίηση Βαθμολογίας </button> 
                                            </a>
                                        </div> 
                                    </div>
                                    <?php } ?>
                                    <div class="card mt-4">
                                        <div class="card-header">
                                                <i class="fas fa-file-csv text-center" style="margin-top:1%;"> </i> Χρήση Αρχείων   
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"> Εισαγωγή - Εξαγωγή Βαθμών </h5>
                                            <p class="card-text"> Υποστηρίζεται η χρήση αρχείων τύπου .csv για την εισαγωγή και την εξαγωγή βαθμών. </p>
                                            <a href="exportcsv.php?id=<?php echo $ID_Lesson ?>" class="btn btn-info"> Εξαγωγή CSV </a>
                                            <form action="importcsv.php" class="mt-1">
                                                <input type="submit" class="btn btn-info" value="Εισαγωγή CSV">
                                                <input type="hidden" name="ID_Course" value="<?php echo $ID_Lesson ?>">
                                                <input type="file" accept=".csv" id="myFile" name="filename" class="btn btn-info">
                                            </form>
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