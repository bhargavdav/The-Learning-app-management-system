<?php
include('root/config.php');

$page_nm = "Profile";
$pageUrl = "profile.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    $qry = "SELECT * FROM tbl_admin WHERE id=".$_SESSION['aid'];
    $row = $ai_db->aiGetQueryObj($qry);
    if (isset($_POST['btn_submit'])) {
        $uname = addslashes($_POST['uname']);
        $email = $_POST['email'];
        $old_pass = $_POST['old_pass'];
        $n_passs = md5($_POST['n_passs']);
        $qry = "UPDATE tbl_admin SET "
                . "username='" . $uname . "',"
                . "email='" . $email . "'";
        if ($old_pass != '') {
            $qry .= ",password='".$n_passs."'";
        }
        $qry .= " WHERE id='".$_SESSION['aid']."'";
        $ai_db->aiQuery($qry);
        ?>
        <script>
            alert('Your Profile Successfully Updated Try Using New Credential!');
              window.location.href = "logout.php";
        </script>
        <?php
      
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo SITE_TITLE; ?> - <?php echo $page_nm; ?></title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="../images/1.png" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/parsley.css">
 
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">

 <?php include('menu.php'); ?>	

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Manage <?php echo $page_nm; ?></h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $page_nm; ?></li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
     </div>
    <!-- End Breadcrumb-->

      	<div class="row">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
          <div class="card-header">Manage <?php echo $page_nm; ?></div>
           <div class="card-body">
            <form name="frm" id="frm" data-parsley-validate method="POST" action="" enctype="multipart/form-data">
			<input type="hidden" name="mode" id="mode" value="<?php echo $_REQUEST['mode']; ?>" />
			<input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" />
			
			<div class="form-group row">
				<label for="input-21" class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" id="uname" name="uname" value="<?php echo $row[0]->username; ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label for="input-21" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" id="email" name="email" value="<?php echo $row[0]->email; ?>">
				</div>
			</div>
			
			<hr>
			
			<div class="form-group row">
				<label for="input-21" class="col-sm-2 col-form-label">Old Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="old_pass" name="old_pass" required />
				</div>
			</div>
			
			<div class="form-group row">
				<label for="input-21" class="col-sm-2 col-form-label">New Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="n_passs" name="n_passs">
				</div>
			</div>
			
			<div class="form-group row">
				<label for="input-21" class="col-sm-2 col-form-label">Confirm Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="cn_pass" name="cn_pass">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-10">
				<button type="submit" name="btn_submit" id="btn_submit" class="btn btn btn-primary"><i class="icon-plus"></i> Submit</button>
				<a href="dashboard.php" class="btn btn-warning"><i class="icon-minus"></i> Cancel</a>
            </div>
          </div>
          </form>
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
          Copyright © 2024 : <?php echo SITE_TITLE; ?>
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
  
  <!--Data Tables js-->
  <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
  
  <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
  <script src="assets/plugins/alerts-boxes/js/sweet-alert-script.js"></script>
  
  <script src="assets/parsley.min.js"></script>  
<script>
$('.delete_check').click(function(e){
	e.preventDefault();
    var link = $(this).attr('href');
	
	swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location.href = link; 
                    }
                  });
	
});
</script>

<?php
if ($_GET['msg'] == '1') {
?>
<script type="text/javascript">
swal("Good job!", "Record Added Successfully!", "success");
</script>
<?php } 
if ($_GET['msg'] == '2') {
?>
<script type="text/javascript">
swal("Updated!", "Record Updated Successfully!", "success");
</script>
<?php }
if ($_GET['msg'] == '3') {
?>
<script type="text/javascript">
swal("Deleted!", "Record Deleted Successfully!", "success");
</script>
<?php
}
?>

<script>
    $(document).ready(function () {
        $("#old_pass").focusout(function () {
            var old_pass = $("#old_pass").val();
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {action: 'check-password', old_pass: old_pass}
            }).done(function (msg) {
                if (msg == 'fail')
                {
                    alert('Invalid Old Password Enter Valid Password!');
                    document.getElementById('old_pass').value = "";
					ocument.getElementById('old_pass').focus();

                } else {
                    var v1 = document.getElementById("n_passs");
                    v1.setAttribute("required", "required");
                    var v2 = document.getElementById("cn_pass");
                    v2.setAttribute("required", "required");
                }
            });
        });
        $("#cn_pass").focusout(function () {
            var n_pass = $("#n_passs").val();
            var cn_pass = $("#cn_pass").val();
            if (n_pass != cn_pass)
            {
                alert('New Password And Confirm Password Does Not Match Please Enter Correct!');
                document.getElementById('cn_pass').value = "";
            }
        });
    });
</script>
</body>
</html>