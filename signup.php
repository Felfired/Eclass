<?php
    include 'includes/connect.php'
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
            <a class="navbar-brand visible-lg-block" href="index.php">
                <img src="assets/img/logo-nav.png" width="30" height="30" class="d-inline-block align-top" alt="">
                ICSD - Eclass
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="login.html">Σύνδεση</a>
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
                        <h3 class="mt-4 mb-3"> Εγγραφή </h1>
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"> <a href="index.php"> Αρχική Σελίδα </a> </li> 
                            <li class="breadcrumb-item active"> Εγγραφή </li>
                        </ol>
                        <br>
                        <!--Static Container-->
                        <div id="static-centered-row">
                            <div class="row mt-5 justify-content-center">
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-primary text-white mb-4 text-center">
                                        <div class="card-body font-italic"> Ως Φοιτητής </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="medium text-white stretched-link" id="student" href="#student"> Συνέχεια </a>
                                            <div class="medium text-white"> 
                                                <i class="fas fa-angle-right"> </i> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-primary text-white mb-4 text-center">
                                        <div class="card-body font-italic"> Ως Διδάσκων </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="medium text-white stretched-link data" id="professor" href="#professor"> Συνέχεια </a>
                                            <div class="medium text-white">
                                                <i class="fas fa-angle-right"> </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End of Static Container-->
                        <!--Dynamic Student Container-->
                        <div id="dynamic-centered-row-1" style="display:none">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                            <div class="card-header">
                                                <h3 class="text-center font-weight-normal my-2"> Αίτηση Λογαριασμού </h3>
                                            </div>
                                            <div class="card-body">
                                                <form action=includes/newstudent.php id="student_form" method="post"">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputFirstName"> Όνομα </label>
                                                                <input class="form-control py-3" id="inputFirstName" type="text" placeholder="" name="inputFirstName" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputLastName"> Επώνυμο </label>
                                                                <input class="form-control py-3" id="inputLastName" type="text" placeholder="" name="inputLastName" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputPassword"> Κωδικός </label>
                                                                <input class="form-control py-3" id="inputPassword" type="password" placeholder="" name="inputPassword" data-toggle="tooltip" data-placement="top" title="Password should be at least 8 characters long." required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputrePassword"> Επανάληψη Κωδικού </label>
                                                                <input class="form-control py-3" id="inputrePassword" type="password" placeholder="" name="inputrePassword" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputYear"> Έτος Εισαγωγής </label>
                                                                <select class="form-control mt-0 input-large" name="inputYear" required>
                                                                    <option disabled selected></option>
                                                                    <option value="2000">2000</option>
                                                                    <option value="2001">2001</option>
                                                                    <option value="2003">2003</option>
                                                                    <option value="2004">2004</option>
                                                                    <option value="2005">2005</option>
                                                                    <option value="2006">2006</option>
                                                                    <option value="2007">2007</option>
                                                                    <option value="2008">2008</option>
                                                                    <option value="2009">2009</option>
                                                                    <option value="2010">2010</option>
                                                                    <option value="2011">2011</option>
                                                                    <option value="2012">2012</option>
                                                                    <option value="2013">2013</option>
                                                                    <option value="2014">2014</option>
                                                                    <option value="2015">2015</option>
                                                                    <option value="2016">2016</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-4 mb-0">
                                                        <input type="submit" class="btn btn-primary btn-block" value="Υποβολή">
                                                    </div>
                                                </form>
                                            </div>
                                        <div class="card-footer text-center">
                                            <div class="small">
                                                <a href="signup.php"> Επιστροφή </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End of Dynamic Student Container-->
                        <!--Dynamic Professor Container-->
                        <div id="dynamic-centered-row-2" style="display:none">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-5">
                                            <div class="card-header">
                                                <h3 class="text-center font-weight-normal my-2"> Αίτηση Λογαριασμού </h3> 
                                            </div>
                                            <div class="card-body">
                                                <form action=includes/newprofessor.php id="student_form" method="post" onsubmit="return passwdValidate()">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputFirstName"> Όνομα </label>
                                                                <input class="form-control py-3" id="inputFirstName" type="text" placeholder="" name="inputFirstName" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputLastName"> Επώνυμο </label>
                                                                <input class="form-control py-3" id="inputLastName" type="text" placeholder="" name="inputLastName" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputUsername"> Αναγνωριστικό </label>
                                                                <input class="form-control py-3" id="inputUsername" type="text" placeholder="" name="inputUsername" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label class="small mb-1" for="inputSpec"> Ειδικότητα </label>
                                                                    <select class="form-control mt-0 input-large" name="inputSpec" required>
                                                                        <option disabled selected></option>
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
                                                                <input class="form-control py-3" id="inputPassword" type="password" placeholder="" name="inputPassword" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputrePassword"> Επανάληψη Κωδικού </label>
                                                                <input class="form-control py-3" id="inputrePassword" type="password" placeholder="" name="inputrePassword" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-4 mb-0">
                                                        <input type="submit" class="btn btn-primary btn-block" value="Υποβολή"> 
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer text-center">
                                                <div class="small">
                                                    <a href="signup.php"> Επιστροφή </a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>