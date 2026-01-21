<?php
include("root/config.php");
$url = "http://localhost/learning/";
if(!isset($_POST['action'])) {
		$arr['status'] = 'Error Action';
		$arr['message'] = 'Input Proper Data';
		header("Content-Type:application/json");
		header("Transfer-Encoding:chunked");
		echo json_encode($arr);
		exit;
	} 
	else{

    switch ($_POST['action']) {

        case 'get_category':
          
            $select_query =  mysqli_query($ai_conn, "SELECT * FROM `tbl_course_category` ORDER BY `id` ASC");
            // case 1 if else
            if (mysqli_num_rows($select_query) > 0) {
                $arr = [];
                while ($row = mysqli_fetch_assoc($select_query)) {
                    $id = $row['id'];
                    $arr[] = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'image' => $row['image'] = $url . "images/" . $row['image'],
                        'status' => $row['status'],
                    );
                }
                $fetch['get_categorey'] = $arr;
                $fetch['status'] = 'success';
                $fetch['message'] = "Successfully";
            } else {
                $fetch['status'] = 0;
                $fetch['message'] = "No record available";
            }
            // end case 1 if else
            header("Content-Type:application/json");
            // $fetch['message']= "add";
            echo json_encode($fetch);
            break;


            case 'get_couse':
                if(isset($_POST['cat_id'])){
                    $cat_id =$_POST['cat_id'];
                    $select_query =mysqli_query($ai_conn,"SELECT *FROM tbl_course WHERE cat_id =$cat_id");
                    if(mysqli_num_rows($select_query)>0){
                        $arr=[];
                        while($row= mysqli_fetch_assoc($select_query)){
                            $id=$row['id'];
                            $arr[] = array(
                                'id' => $row['cat_id'],
                                'name' => $row['name'],
                                'image' => $row['image'] = $url . "images/" . $row['image'],
                                'level' =>$row['level'],
                                'enroll status' => $row['enrol_status'],
                                'description' =>$row['description'],
                                'status' => $row['status'],
                            );
                        }
                        $fetch['get_course'] = $arr;
                        $fetch['status'] = 'success';
                        $fetch['message'] = "Successfully";
                    }
                    else{
                        $fetch['status']= 0;
                        $fetch['message']= "No recode Available";
                    } 
                }
                else{
                    $fetch['status']=0;
                    $fetch['message']="Please enter category id";
                }
                header("Content-Type:application/json");
                // $fetch['message']= "add";
                echo json_encode($fetch);
                break;

            default:
            $fetch['status'] = 'Error';
            $fetch['message'] = 'Enter Correct Category';
            header("Content-Type:application/json");
            header("transfer-encoding:chunked");
            echo json_encode($fetch);
            break;
    }
	}

