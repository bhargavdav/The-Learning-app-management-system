<?php
include('root/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?php echo SITE_TITLE; ?> - Dashboard</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="../images/1.png" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS-->
  <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet" />
  <!-- skins CSS-->
  <link href="assets/css/skins.css" rel="stylesheet" />
</head>

<body>

  <!-- Start wrapper-->
  <div id="wrapper">

    <?php include('menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix"></div>
    <div class="ds-card">
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumb-->
          <div class="row mt-3">

            <div class="col-12 col-lg-6 col-xl-3">
              <div class="card gradient-deepblue">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php
                                              $app_qry = "SELECT count(*) as total_count FROM tbl_learning_course";
                                              $app_row = $ai_db->aiGetQuery($app_qry);
                                              echo $app_row[0]['total_count'];
                                              ?><span class="float-right"><i class="fa fa-bars"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:100%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Total Course</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="card gradient-orange">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php
                                              $app_qry1 = "SELECT count(*) as total_count FROM tbl_learning_course_category";
                                              $app_row1 = $ai_db->aiGetQuery($app_qry1);
                                              echo $app_row1[0]['total_count'];
                                              ?><span class="float-right"><i class="fa fa-bars"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:100%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Total Course Category</p>
                </div>
              </div>
            </div>
          </div>
        </div><!--End Row-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
      </div>
      <!-- End container-fluid-->

    </div><!--End content-wrapper-->

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    <footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2024 <?php echo SITE_TITLE; ?>
        </div>
      </div>
    </footer>
    <!--End footer-->


  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>

</body>

</html>