<?php 
    session_start();
    include 'includes/connect.php';

    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else  if($_SESSION['Type'] == 3)
    { 
        date_default_timezone_set("Europe/Athens");
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
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
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
                                    <h3 class="mt-4 mb-3">Στατιστικά Μαθήματος</h1>
                                        <ol class="breadcrumb mb-2">
                                            <li class="breadcrumb-item"> <a href="professor.php"> Αρχική Σελίδα </a> </li> 
                                            <li class="breadcrumb-item"> <a href="professor_courses.php"> Μαθήματα </a> </li>
                                            <li class="breadcrumb-item active"> Στατιστικά Μαθήματος </li> 
                                        </ol>
                                        <div class="col-lg-6">
                                            <div class="card mb-4">
                                                <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Ποσοστό Επιτυχίας</div>
                                                <div class="card-body"><canvas id="myBarChart" width="100%" height="100"></canvas></div>
                                                    <div id="chartContainer" style="width: 100%; height: auto;">
                                                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                                    </div>
                                                <div class="card-footer small text-muted">Updated <?php echo date("h:i:sa") ?> </div>
                                            </div>
                                        </div>
                                </div>
                                
                                <?php
                                    $ID_Course = $_GET['id'];
                                    $sqlQuery = "SELECT Grade FROM student_exams WHERE ID_Course = '$ID_Course' AND isFinal = 1 ";
                                    $result = mysqli_query($conn,$sqlQuery);
                                    $success = 0;
                                    $fail = 0;
                                    $counter = 0;
                                    $array = array();
                                    while($row = mysqli_fetch_array($result)){
                                        if($row['Grade']>=5){
                                            $success = $success + 1;
                                        }
                                        else{
                                            $fail = $fail + 1;
                                        }
                                       $counter = $counter + 1;
                                    }
                                    if($counter!=0){
                                        $success = ($success/$counter)*100;
                                        $fail = ($fail/$counter)*100;
                                        array_push($array , round($success, 2));
                                        array_push($array , round($fail, 2));
                                    }
                                   
                                ?>
                               

                                <script>
                                    var array = <?php echo json_encode($array); ?>;
                                    var type = ["Ποσοστό Επιτυχίας (%)", "Ποσοστό Αποτυχίας (%)"];
                                    var pieColors = ["green", "red"];

                                    new Chart("myChart", {
                                    type: "pie",
                                    data: {
                                        labels: type ,
                                        datasets: [{
                                        backgroundColor: pieColors,
                                        data: array
                                        }]
                                    },
                                    options: {
                                        legend: {display: false},
                                        title: {
                                        display: true,
                                        text: "Ποσοστό Επιτυχίας."
                                        }
                                    }
                                    });
                                </script>
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
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                    <script src="js/scripts.js"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                    <script src="assets/demo/datatables-demo.js"></script>
                </body>
            </html>
        <?php } 
?>