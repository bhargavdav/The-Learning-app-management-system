<?php
include('root/config.php');

$page_nm = "Quiz";
$pageUrl = "manage_quiz.php";
$imageUrl = "images/";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if ($_GET['mode'] != '') {
    $id = (int) $_REQUEST['id'];

    if (isset($_POST['btn_submit'])) {
        $id = $_POST['id'];
        $category = $_POST['category'];
        $question = $_POST['question'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $answer = $_POST['answer'];
        $status = $_POST['status'];
        //add record
        if ($_POST['id'] == '' && $_POST['mode'] == 'add') {
            $add_qry = "INSERT INTO tbl_learning_quiz SET
            id='" . $id . "',
            category='" . $category . "',
            question='" . $question . "',
            a='" . $a . "',
            b='" . $b . "',
            c= '" . $c . "',
            d= '" . $d . "',
            answer= '" . $answer . "',
            status='" . $status . "'";
            $ai_db->aiQuery($add_qry);
            $ai_core->aiGoPage($pageUrl . "?msg=1");
        }
        //edit record
        if ($_POST['id'] != '' && $_POST['mode'] == 'edit') {
            $editqry = "UPDATE tbl_learning_quiz SET 
                 id='" . $id . "',
                 category='" . $category . "',
                 question='" . $question . "',
                 a='" . $a . "',
                 b='" . $b . "',
                 c= '" . $c . "',
                 d= '" . $d . "',
                 answer= '" . $answer . "',
                 status='" . $status . "'
                 WHERE id=" . $id;
            $ai_db->aiQuery($editqry);
            $ai_core->aiGoPage($pageUrl . "?msg=2");
        }
    }
    //delete record
    if ($_GET['mode'] == 'delete' && $id != '') {
        $qry_del_su = "Delete from tbl_learning_quiz WHERE id=" . $id;
        $ai_db->aiQuery($qry_del_su);

        $ai_core->aiGoPage($pageUrl . "?msg=3");
    }
    //get data for edit
    if ($id != '') {
        $qry = "SELECT * FROM tbl_learning_quiz WHERE id='" . $id . "'";
        $row = $ai_db->aiGetQueryObj($qry);
    }
} else {
    //select all record
    $qry = "SELECT * FROM tbl_learning_quiz ORDER BY id ASC";
    $result = $ai_db->aiGetQueryObj($qry);
}
// Check if a course category is selected for filtering
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_filter']) && $_POST['category_filter'] != '') {
    $category_filter = $_POST['category_filter'];
    $qry = "SELECT * FROM tbl_learning_quiz WHERE category = '" . $category_filter . "' ORDER BY id ASC";
} else {
    // Default query without filtering
    $qry = "SELECT * FROM tbl_learning_quiz ORDER BY id ASC";
}
$result = $ai_db->aiGetQueryObj($qry);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo SITE_TITLE; ?> - <?php echo $page_nm; ?></title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="../images/1.png" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--Data Tables -->
    <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/parsley.css">


</head>

<body>
    <script src="<?php ADMIN_URL; ?>ckeditor/ckeditor.js"></script>
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
                    <form method="POST" action="<?php echo $pageUrl; ?>">
                        <div class="form-group row">
                            <!-- <label for="category_filter" class="col-md-4 col-form-label">Select Course</label> -->
                            <div class="filter">
                                <div class="col-md-12">
                                    <select class="form-control" id="category_filter" name="category_filter">
                                        <option value="">Select Course Category</option>
                                        <?php
                                        // Fetch course categories from the database
                                        $categories = $ai_db->aiGetQueryObj("SELECT id, name FROM " . DB_PREFIX . "learning_course WHERE status='active' ORDER BY id ASC");
                                        foreach ($categories as $category) {
                                            echo "<option value='" . $category->id . "'>" . $category->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-btn">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-0">
                        <div class="float-sm-right">
                            <?php if ($_REQUEST['mode'] != 'add') { ?>
                                <a href="<?php echo $pageUrl . '?mode=add'; ?>" class="btn btn-success m-1"> <i class="fa fa-plus"></i> <span>Add <?php echo $page_nm; ?></span> </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- End Breadcrumb-->
                <?php if ($_REQUEST['mode'] != '') { ?>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xl-12">

                            <div class="card">
                                <div class="card-header">Add <?php echo $page_nm; ?></div>
                                <div class="card-body">
                                    <form name="frm" id="frm" data-parsley-validate method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="mode" id="mode" value="<?php echo $_REQUEST['mode']; ?>" />
                                        <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" />


                                        <div class="form-group row">
                                            <label for="input-23" class="col-sm-2 col-form-label">Select Main Category</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="category" name="category" data-parsley-required="true">
                                                    <option value="">Select Course Category</option>
                                                    <?php
                                                    $qrys = "SELECT * FROM " . DB_PREFIX . "learning_course WHERE status='active' ORDER BY id ASC";
                                                    $rows = $ai_db->aiGetQueryObj($qrys);
                                                    foreach ($rows as $mcrow) {
                                                    ?>
                                                        <option <?php if ($row[0]->category == $mcrow->id) { ?> selected <?php  } ?> value="<?php echo $mcrow->id; ?>"><?php echo $mcrow->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label">Question</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="question" name="question" value="<?php echo $row[0]->question; ?>" placeholder="Enter question" data-parsley-required="true">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label">A</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="a" name="a" value="<?php echo $row[0]->a; ?>" placeholder="Enter Option A" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label">B</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="b" name="b" value="<?php echo $row[0]->b; ?>" placeholder="Enter Option B" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label">C</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="c" name="c" value="<?php echo $row[0]->c; ?>" placeholder="Enter Option C" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label">D</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="d" name="d" value="<?php echo $row[0]->d; ?>" placeholder="Enter Option D" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label">Answer</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="answer" name="answer" value="<?php echo $row[0]->answer; ?>" placeholder="Enter the Correct answer" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label for="input-21" class="col-sm-2 col-form-label"> Description </label>
                                            <div class="col-sm-10">
                                                <textarea type="text" class="form-control" id="editor2" name="description" value="" placeholder="Enter Course Description " data-parsley-required="false"><?php echo $row[0]->description; ?></textarea>
                                            </div>
                                        </div> -->

                                        <!-- <div class="form-group row">

                                            <label for="input-21" class="col-sm-2 col-form-label">Course Image</label>
                                            <div class="col-sm-10">
                                                <!-- <div class="text" style="color:black;"><b>Note:</b>File Size Must Be 570 x 320</div>  
                                                <input type="file" name="image" id="image" <?php //if ($_GET['mode'] == 'add') { 
                                                                                            ?> data-parsley-required="true" <?php //} 
                                                                                                                            ?> />
                                                <?php //if ($row[0]->image != '') { 
                                                ?>
                                                    <img src="<?php //echo $imageUrl . $row[0]->image 
                                                                ?>" width="200" />
                                                <?php //} 
                                                ?>
                                                <input type="hidden" name="old_file_name" id="old_file_name" value="<?php //echo $row[0]->image 
                                                                                                                    ?>" />
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group row">
                                            <label for="input-23" class="col-sm-2 col-form-label">Enroll Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="enrol_status" name="enrol_status" data-parsley-required="true">
                                                    <option value="">Select Enroll</option>
                                                    <option value="1" <?php //if ($row[0]->enrol_status == '1') { 
                                                                        ?> selected="selected" <?php //} 
                                                                                                ?>>Yes</option>
                                                    <option value="0" <?php //if ($row[0]->enrol_status == '0') { 
                                                                        ?> selected="selected" <?php //} 
                                                                                                ?>>No</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="form-group row">
                                            <label for="input-23" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="status" name="status" data-parsley-required="true">
                                                    <option value="">Select Status</option>
                                                    <option value="Active" <?php if ($row[0]->status == 'Active') { ?> selected="selected" <?php } ?>>Active</option>
                                                    <option value="Deactive" <?php if ($row[0]->status == 'Deactive') { ?> selected="selected" <?php } ?>>Deactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn btn-primary"><i class="icon-plus"></i> Submit</button>
                                                <a href="manage_course.php" class="btn btn-warning"><i class="icon-minus"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--End Row-->
                <?php } else { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><i class="fa fa-table"></i> List Of <?php echo $page_nm; ?></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Question</th>
                                                    <th>A</th>
                                                    <th>B</th>
                                                    <th>C</th>
                                                    <th>D</th>
                                                    <th>answer</th>
                                                    <th>status</th>
                                                    <th>Uploaded_at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (COUNT($result) > 0) {
                                                    foreach ($result as $row) {
                                                ?>
                                                        <tr>

                                                            <td><?php echo $ai_core->aiGetValue(DB_PREFIX . "learning_course", "name", "id", $row->category); ?></td>   
                                                            <td><?php echo $row->question; ?></td>
                                                            <td><?php echo $row->a; ?></td>
                                                            <td><?php echo $row->b; ?></td>
                                                            <td><?php echo $row->c; ?></td>
                                                            <td><?php echo $row->d; ?></td>
                                                            <td><?php echo $row->answer; ?></td>
                                                            <td><?php echo $row->status; ?></td>
                                                            <td><?php echo date("d-m-Y g:i A", strtotime($row->last_update)); ?></td>
                                                            <td>
                                                                <a href="<?php echo $pageUrl . "?mode=edit&id=" . $row->id . ""; ?>" class="btn btn-primary m-1">Edit</a>
                                                                <a href="<?php echo $pageUrl . "?mode=delete&id=" . $row->id . "&cat_id=" . $row->cat_id . ""; ?>" class="delete_check btn btn-danger m-1">Delete</a>
                                                            </td>

                                                        </tr>
                                                <?php }
                                                } ?>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Row-->
                <?php } ?>
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
        $('.delete_check').click(function(e) {
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

    <script>
        // $(document).ready(function () {
        //     $("#main_cat_id").click(function () {
        //         var main_cat_id = $(this).val();
        //         $.ajax({
        //             type: "POST",
        //             data: {cat_id:main_cat_id},
        //             url: "get_category.php",
        //             success: function(data){
        //                 $("#cat_id").html(data);
        //             }
        //         });
        //     });
        // });    
    </script>

    <script>
        // $(document).ready(function () {
        //     $("#cat_id").click(function () {
        //         var cat_id = $(this).val();
        //         $.ajax({
        //             type: "POST",
        //             data: {cat_id:cat_id},
        //             url: "get_subcategory.php",
        //             success: function(data){
        //                 $("#sub_cat_id").html(data);
        //             }
        //         });
        //     });
        // });    
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
        $(document).ready(function() {
            //Default data table
            $('#default-datatable').DataTable();
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });
            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        CKEDITOR.replace('editor2');
    </script>


</body>

</html>