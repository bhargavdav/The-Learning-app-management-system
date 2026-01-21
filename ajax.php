<?php

include 'root/config.php';
if (!isset($_POST['action'])) {
    echo '';
    exit;
}
if ($_POST['action'] == 'login') {
    $loginUname = addslashes($_POST['loginUname']);
    $loginPassword = md5($_POST['loginPassword']);
    $qry = "SELECT * FROM " . DB_PREFIX . "learning_admin WHERE  username='" . $loginUname . "'";
    $row = $ai_db->aiGetQuery($qry);
    if (count($row)) {
        foreach ($row as $user) {
            if ($loginPassword == $user['password']) {
                if ($user['is_active'] == '1') {
                    $_SESSION['aid'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    $data = "success";
                } else {
                    $data = "not active";
                }
            }
        }
    } else {
        $data = "not found";
    }
    echo $data;
}

if ($_POST['action'] == 'check-password') {
    $OldPassword = md5($_POST['old_pass']);
    $qry = "SELECT * FROM " . DB_PREFIX . "admin WHERE password='" . $OldPassword . "' AND id=" . $_SESSION['aid'];
    $result = $ai_db->aiGetQueryObj($qry);
    if (empty($result)) {
        echo 'fail';
    } else {
        echo 'success';
    }
}
