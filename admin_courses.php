<?php 
        session_start();
        include 'includes/connect.php';
        if (isset($_SESSION['Type']) == false)
        {
            header("Location: index.php");
        }
        else if($_SESSION['Type'] == 1) 
        $query = "SELECT * FROM course";
        $result = mysqli_query($conn, $query);
        { ?>
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
                                    <div class="container-fluid">
                                        <h3 class="mt-4 mb-3">Μαθήματα</h1>
                                        <ol class="breadcrumb mb-2">
                                            <li class="breadcrumb-item"> <a href="admin.php"> Αρχική Σελίδα </a> </li> 
                                            <li class="breadcrumb-item active"> Μαθήματα </li>
                                        </ol>
                                        <div class="static-row-container">
                                            <div class="row mt-1 justify-content-center">
                                                <div class="col-xl-12">
                                                    <div class="card mb-4 mt-5" id="courses_card">
                                                        <div class="card-header">
                                                            <i class="fas fa-table text-center" style="margin-top:1%;"> </i> Λίστα Μαθημάτων 
                                                            <button type="button" class="btn btn-success btn-md float-right" id="add_course" onclick="hideCourses('courses_card');displayCourses('dynamic_row');"> <i class="fas fa-plus"> </i> </button>  
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed; width: 100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Ρυθμίσεις</th>
                                                                            <th>Όνομα</th>
                                                                            <th>Κωδικός</th>
                                                                            <th>Περιγραφή</th>
                                                                            <th>Προαπαιτούμενα</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php while($row = mysqli_fetch_array($result))   
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td> 
                                                                                    <a href="admin_matchcourse.php?id=<?php echo $row['ID']?>" style="text-decoration: none;"> <button type="button" class="btn btn-primary"><i class="fas fa-laptop-code"> </i> </button> </a>
                                                                                    <a href="admin_editcourse.php?id=<?php echo $row['ID']?>" style="text-decoration: none;"> <button type="button" class="btn btn-success"><i class="fas fa-edit"> </i> </button> </a>
                                                                                    <a href="functionsdelete_.php?id=<?php echo $row['ID'].',1'?>" style="text-decoration: none;"> <button type="button" class="btn btn-danger"><i class="fas fa-trash"> </i> </button> </a>
                                                                                </td>
                                                                                <td style="word-wrap: break-word" > <?php echo $row['Name'] ?> </td>
                                                                                <td style="word-wrap: break-word" id="<?php echo $row['ID'] ?>"> <?php echo $row['ID'] ?> </td>
                                                                                <td style="word-wrap: break-word"> <?php echo $row['Description'] ?> </td>
                                                                                <td style="word-wrap: break-word"> 
                                                                                    <?php
                                                                                        $ID = $row['ID'];
                                                                                        $q = "SELECT ID_Req FROM course_req WHERE ID_Course = '$ID'";
                                                                                        $r = mysqli_query($conn, $q);
                                                                                        while ($row = mysqli_fetch_assoc($r)) 
                                                                                        {
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
                                                                        <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Start Of Dynamic Course Form-->
                                        <div class="container-fluid" style="display: none;" id="dynamic_row"> 
                                            <div class="row mt-1 justify-content-center">
                                                <div class="col-lg-9">
                                                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                                        <div class="card-header">
                                                            <h3 class="text-center font-weight-normal my-2"> Εισαγωγή Μαθήματος </h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action=includes/newcourse.php id="student_form" method="post">
                                                                <div class="form-row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="LessonName"> Τίτλος Μαθήματος </label>
                                                                            <input class="form-control py-3" id="inputLessonName" type="text" placeholder="" name="inputLessonName" required/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="ID"> Αναγνωριστικό Μαθήματος </label>
                                                                            <input class="form-control py-3" id="inputID" type="text" placeholder="" name="inputID" required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="small mb-1" for="inputDescription"> Περιγραφή </label>
                                                                            <input class="form-control py-3" id="inputDescription" type="text" placeholder="" name="inputDescription" required/>
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
                                                                                <input type="submit" class="btn btn-primary btn-block" value="Υποβολή">
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