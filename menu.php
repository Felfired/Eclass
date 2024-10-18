<?php
    include 'includes/connect.php';
    if (isset($_SESSION['Type']) == false)
    {?>
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">
					<div class="sb-sidenav-menu-heading">Βασικες Επιλογες</div>
					<a class="nav-link" href="courses.php">
					<div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
						Μαθήματα
					</a>
					<a class="nav-link" href="signup.php">
					<div class="sb-nav-link-icon"><i class="fas fa-pencil-alt"></i></div>
						Εγγραφή
					</a>
				</div>
			</div>
			<div class="sb-sidenav-footer">
				<div class="small">Έχετε αποσυνδεθεί.</div>
			</div>
		</nav>
    <?php }
    else if($_SESSION['Type'] == 1) 
    {?>
		<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">
						<div class="sb-sidenav-menu-heading">Βασικες Επιλογες</div>
						<a class="nav-link" href="admin_courses.php">
							<div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
							&nbsp;Μαθήματα
						</a>
						<a class="nav-link" href="professor_grading.php">
							<div class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
							&nbsp;Βαθμολογίες
						</a>
						<a class="nav-link" href="admin_teaching.php">
							<div class="sb-nav-link-icon"><i class="fas fa-chalkboard"></i></div>
							Διδασκαλία
						</a>
						<div class="sb-sidenav-menu-heading">Ρυθμισεις Χρηστων</div>
						<a class="nav-link" href="admin_stprefs.php">
							<div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
							&nbsp;Φοιτητές
						</a>
						<a class="nav-link" href="admin_prprefs.php">
							<div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
								Προσωπικό
						</a>
						<a class="nav-link" href="admin_actuser.php">
							<div class="sb-nav-link-icon"><i class="fas fa-user-check"></i></div>
								Ενεργοποίηση Χρηστών
						</a> 
				</div>
			</div>
			<div class="sb-sidenav-footer">
				<div class="small">Έχετε συνδεθεί ως: <?php echo $_SESSION['Username']; ?> </div>
			</div>
		</nav>

	<?php }
	else if($_SESSION['Type'] == 2)
	{?>
		<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">
					<div class="sb-sidenav-menu-heading">Βασικες Επιλογες</div>
						<a class="nav-link" href="student_courses.php">
							<div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
							&nbsp;Τα Μαθήματα μου
						</a>
						<a class="nav-link" href="student_grading.php">
							<div class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
							&nbsp;Οι Βαθμολογίες μου
						</a>
						<a class="nav-link" href="student_startexams.php">
							<div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
							&nbsp;Δήλωση Μαθημάτων
						</a>
						<a class="nav-link" href="student_displaystats.php">
							<div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
							&nbsp; Τα Στατιστικά μου
						</a>
				</div>
			</div>
			<div class="sb-sidenav-footer">
				<div class="small">Έχετε συνδεθεί ως: <?php echo $_SESSION['Username']; ?> </div>
			</div>
		</nav>

	<?php }
	else if($_SESSION['Type'] == 3)
	{?>
		<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">
					<div class="sb-sidenav-menu-heading">Βασικες Επιλογες</div>
						<a class="nav-link" href="professor_courses.php">
							<div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
							&nbsp;Μαθήματα
						</a>
						<a class="nav-link" href="professor_grading.php">
							<div class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
							&nbsp;Βαθμολογίες
						</a>
						<a class="nav-link" href="professor_charts.php">
							<div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
							&nbsp;Στατιστικά
						</a>
				</div>
			</div>
			<div class="sb-sidenav-footer">
				<div class="small">Έχετε συνδεθεί ως: <?php echo $_SESSION['Username']; ?> </div>
			</div>
		</nav>
	<?php }
?>