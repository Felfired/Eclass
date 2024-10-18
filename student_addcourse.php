<?php 
    session_start();
    include 'includes/connect.php';
    include 'includes/functions.php';

    if (isset($_SESSION['Type']) == false)
    {
        header("Location: index.php");
    }
    else if($_SESSION['Type'] == 2) 
    { 
        $ID_Student = $_SESSION['Username'];
        $sql = "SELECT ID  FROM course ";
        $result_course = mysqli_query($conn , $sql);
        
        $sql1 = "SELECT ID_Course FROM student_course WHERE ID_Student = '$ID_Student' ";
        $result_student_course = mysqli_query($conn , $sql1);
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
                                    <h3 class="mt-4 mb-3">Εγγραφή</h1>
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"> <a href="student.php"> Αρχική Σελίδα </a> </li> 
                                        <li class="breadcrumb-item"> <a href="student_courses.php"> Τα Μαθήματα μου </a> </li>
                                        <li class="breadcrumb-item active"> Εγγραφή </li>
                                    </ol>
                                    <!--Start Of Dynamic Course Form-->
                                    <div class="static-row-container">
                                        <div class="row mt-1 justify-content-center">
                                            <div class="col-xl-12">
                                                <div class="card mb-4 mt-5" id="dynamic_row" >
                                                    <div class="card-header">
                                                        <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Λίστα Μαθημάτων 
                                                        <a href="student_courses.php">
                                                        <button type="button" class="btn btn-success btn-md float-right" id="back" data-toggle="tooltip" data-placement="top" title="Επιστροφή"> <i class="fa fa-chevron-right"> </i> </button>  
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" method = "post" id="dataTable2" width="100%" cellspacing="0" style="table-layout: fixed; width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Εγγραφή</th>
                                                                        <th>Κωδικός</th>
                                                                        <th>Όνομα</th>
                                                                        <th>Περιγραφή</th>
                                                                        <th>Προαπαιτούμενα</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                <?php 

                                                                    while($row = mysqli_fetch_array($result_course))
                                                                    {
                                                                        $flag = 0;
                                                                        while($row1 = mysqli_fetch_array($result_student_course)){
                                                                            if($row['ID'] == $row1['ID_Course']){
                                                                                $flag=1;
                                                                                break;
                                                                            }  
                                                                        }  
                                                                        if($flag==0){
                                                                        ?>
                                                                        <tr>
                                                                            <td > 
                                                                                <a href="student_confirmadd.php?id=<?php echo $row['ID']?>"> <button type="submit" class="btn btn-success"  name = "addcourse"><i class="fas fa-person-booth" ></i> </button> </a>

                                                                            </td>
                                                                            <td style="word-wrap: break-word"> <?php echo $row['ID'] ?> </td>
                                                                            <td style="word-wrap: break-word" > <?php 
                                                                                $ID = $row['ID'];
                                                                                $sql3 = "SELECT Name FROM course WHERE ID = '$ID'";
                                                                                $Name = mysqli_query($conn , $sql3);
                                                                                $Result_Name  = mysqli_fetch_assoc($Name)['Name'];
                                                                                echo $Result_Name ;?> 
                                                                            </td>
                                                                            <td style="word-wrap: break-word" > <?php
                                                                                $sql4 = "SELECT Description FROM course WHERE ID = '$ID'";
                                                                                $Description = mysqli_query($conn , $sql4);
                                                                                $Result_Description  = mysqli_fetch_assoc($Description)['Description'];
                                                                                echo $Result_Description; ?> 
                                                                            </td>
                                                                            
                                                                            <td style="word-wrap: break-word"> 
                                                                                        <?php
                                                                                            $ID = $row['ID'];
                                                                                            $q = "SELECT ID_Req FROM course_req WHERE ID_Course = '$ID'";
                                                                                            $r = mysqli_query($conn, $q);
                                                                                            while ($row = mysqli_fetch_assoc($r)) {
                                                                                                $ID = $row['ID_Req'];
                                                                                                $q1 = "SELECT Name FROM course WHERE ID = '$ID'";
                                                                                                $r1 = mysqli_query($conn, $q1);
                                                                                                if(mysqli_num_rows($r1)!=0)
                                                                                                {
                                                                                                    $req = mysqli_fetch_assoc($r1)["Name"];
                                                                                                    echo $req."<br>";                                                    
                                                                                                }
                                                                                            }?>
                                                                                    </td>
                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                    }?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Of Dynamic Course Container-->
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
                    <script src="js/custom.js"></script>
                    <script src="assets/demo/chart-area-demo.js"></script>
                    <script src="assets/demo/chart-bar-demo.js"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                    <script src="assets/demo/datatables-demo.js"></script>
                </body>
            </html>
    <?php }
?>