<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> Eclass </title>
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
                        <a class="dropdown-item" href="index.php"> Σύνδεση </a>
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
                        <h3 class="mt-4"> Πλατφόρμα Ηλετρονικής Εκπαίδευσης </h1>
                    </div>
                    <div class="card mt-5 mb-5" style="height: 15rem; background-color: #007bff; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body main">
                            <div class="login-form float-right container-fluid bg-light">
                                <form action="includes/login.php" method="post">
                                    <h3 class="text-center mb-4"> Σύνδεση Χρήστη </h3>    
                                    <hr> </hr>   
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Όνομα Χρήστη" required="required" id="username" name="Username"        >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Συνθηματικό" required="required" id="password" name="Passwd">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> Σύνδεση </button>
                                    </div>
                                    <div class="clearfix">
                                        <label class="float-left form-check-label"> <input type="checkbox"> Θυμήσου Με </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid pt-4" style="display:none">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Έχετε εισάγει λανθασμένα στοιχεία χρήστη! Προσπαθήστε ξανά.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
