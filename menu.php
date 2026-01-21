<!--Start sidebar-wrapper-->
<?php
if ($_SESSION['aid'] == "") {
?>
	<script type="text/javascript">
		document.location.href = 'index.php';
	</script>
<?php
}
?>
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
	<div class="brand-logo">
		<!-- <img src="./get image/logo.png" class="logo-icon" alt="logo icon"> -->
		<h4>THE LEARNERS</h4>
		<div class="close-btn"><i class="zmdi zmdi-close"></i></div>
	</div>

	<ul class="metismenu" id="menu">
		<li>
			<a class="" href="dashboard.php">
				<div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>
		<li>
			<a class="has-arrow" href="javascript:void();">
				<div class="parent-icon"> <i class='zmdi zmdi-format-list-bulleted'></i></div>
				<div class="menu-title">Manage Course</div>
			</a>
			<ul>
				<li><a href="manage_course_cat.php"><i class="zmdi zmdi-dot-circle-alt"></i>Course Categoary
					</a></li>
				<li><a href="manage_course.php"><i class="zmdi zmdi-dot-circle-alt"></i>Course
					</a></li>
				<li><a href="manage_quiz.php"><i class="zmdi zmdi-dot-circle-alt"></i>Quiz
					</a></li>
				<li><a href="manage_enroll_course.php"><i class="zmdi zmdi-dot-circle-alt"></i>User Enroll Course
					</a></li>
			</ul>
		</li>



	</ul>

</div>
<!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
	<nav id="header-setting" class="navbar navbar-expand fixed-top">

		<div class="toggle-menu">
			<i class="zmdi zmdi-menu"></i>
		</div>


		<ul class="navbar-nav align-items-center right-nav-link ml-auto">
			<li class="nav-item dropdown search-btn-mobile">
				<a class="nav-link position-relative" href="javascript:void();">
					<i class="zmdi zmdi-search align-middle"></i>
				</a>
			</li>


			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown" href="javascript:void();">
					<span class="user-profile"><img src="assets/images/use_icon.png" class="img-circle" alt="user avatar"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="dropdown-item user-details">
						<a href="javaScript:void();">
							<div class="media">
								<div class="avatar"><img class="align-self-start mr-3" src="assets/images/use_icon.png" alt="user avatar"></div>
								<div class="media-body">
									<h6 class="mt-2 user-title"><?php echo $_SESSION['username']; ?></h6>
									<p class="user-subtitle"><?php echo $_SESSION['email']; ?></p>
								</div>
							</div>
						</a>
					</li>
					<li class="dropdown-divider"></li>
					<li class="dropdown-item"><a href="profile.php"><i class="zmdi zmdi-balance-wallet mr-3"></i>Profile</a></li>
					<li class="dropdown-divider"></li>
					<li class="dropdown-item"><a href="logout.php"><i class="zmdi zmdi-power mr-3"></i>Logout</a></li>
				</ul>
			</li>
		</ul>
	</nav>
</header>