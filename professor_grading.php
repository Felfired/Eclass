<?php 
    session_start();
    include 'includes/connect.php';
    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else  if($_SESSION['Type'] == 3)
    { 
        $ID_Professor = $_SESSION['Username'];
        $Name_Courses = "SELECT Lesson, ID FROM teaching WHERE Professor='$ID_Professor'";
        $Result_Courses = mysqli_query($conn , $Name_Courses);
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
                                        <li class="breadcrumb-item active"> Βαθμολογίες </li>
                                    </ol>
                                    <div class="row mt-1 justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="card mb-4 mt-5" id="courses_card">
                                                <div class="card-header">
                                                    <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Λίστα Μαθημάτων   
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed; width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Ρυθμίσεις</th>
                                                                    <th>Όνομα</th>
                                                                    <th>Κωδικός</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php while($row = mysqli_fetch_array($Result_Courses))
                                                                {
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="professor_setgrade.php?id=<?php echo $row['ID'] ?>" style="text-decoration: none;"> <button type="button" class="btn btn-primary"><i class="fas fa-sync-alt"> </i> </button> </a>
                                                                            <a href="professor_coursegrade.php?id=<?php echo $row['ID'] ?>" style="text-decoration: none;"> <button type="button" class="btn btn-success"><i class="fas fa-user-graduate"> </i> </button> </a>
                                                                        </td>
                                                                        <td style="word-wrap: break-word" > <?php echo $row['Lesson'] ?> </td>
                                                                        <td style="word-wrap: break-word" id="<?php echo $row['Lesson'] ?>"> <?php echo $row['ID'] ?> </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
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
        <?php     
    }
    else if($_SESSION['Type'] == 1)
    {
        $Name_Courses = "SELECT Lesson , ID FROM teaching ";

        $Result_Courses = mysqli_query($conn , $Name_Courses);
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
                                        <li class="breadcrumb-item"> <a href="student.php"> Αρχική Σελίδα </a> </li> 
                                        <li class="breadcrumb-item active"> Μαθήματα </li>
                                    </ol>
                                    <div class="row mt-1 justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="card mb-4 mt-5" id="courses_card">
                                                <div class="card-header">
                                                    <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Λίστα Μαθημάτων   
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed; width: 95%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Ρυθμίσεις</th>
                                                                    <th>Όνομα</th>
                                                                    <th>Κωδικός</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php while($row = mysqli_fetch_array($Result_Courses))
                                                                {
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="professor_setgrade.php?id=<?php echo $row['ID'] ?>" style="text-decoration: none;"> <button type="button" class="btn btn-primary"><i class="fas fa-sync-alt"> </i> </button> </a>
                                                                            <a href="professor_coursegrade.php?id=<?php echo $row['ID'] ?>" style="text-decoration: none;"> <button type="button" class="btn btn-success"><i class="fas fa-user-graduate"> </i> </button> </a>
                                                                        </td>
                                                                        <td style="word-wrap: break-word" > <?php echo $row['Lesson'] ?> </td>
                                                                        <td style="word-wrap: break-word" id="<?php echo $row['ID'] ?>"> <?php echo $row['ID'] ?> </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
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
        <?php     
    } 
?>