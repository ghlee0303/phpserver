<?php
include "./db.php";

function user_auth_update($mysqli) {
    $table_data = json_decode($_POST['table_data_array']);

    foreach ($table_data as $key => $value) {
        if ($_POST['jud']) {
            $user_auth_sql = "UPDATE user SET position = $_POST[auth] WHERE name = '$value->_name' AND user_id = '$value->_id'";
        } else {
            $user_auth_sql = "UPDATE user SET position = NULL WHERE name = '$value->_name' AND user_id = '$value->_id'";
        }
        $result = mysqli_query($mysqli, $user_auth_sql);

        /*
        echo "$sql_brod\n";
        if ($result) {
        echo "user_auth_sql 쿼리성공\n";
        } else {
        echo "user_auth_sql 쿼리실패\n";
        echo mysqli_error($mysqli);
        echo "\n";
        }
        */
    }
}

function branch_insert_or_delete($mysqli) {
    if ($_POST['jud']) {
        $branch_sql = "INSERT INTO branch SET branch_name = '$_POST[branch_name]'";
        $result = mysqli_query($mysqli, $branch_sql);
    } else {
        $branch_sql = "UPDATE branch SET delete_yn = 1 WHERE branch_name = '$_POST[branch_name]'";
        $branch_result = mysqli_query($mysqli, $branch_sql);

        $user_sql = "UPDATE user SET branch = null WHERE branch_id = '$_POST[branch_name]'";
        $user_result = mysqli_query($mysqli, $user_sql);

    }
}

function install_update($mysqli) {
    $table_data = json_decode($_POST['table_data_array']);

    foreach ($table_data as $key => $value) {
        if ($_POST['jud']) {
            $install_seq = "(SELECT count(*) AS count FROM install WHERE user_id = $_POST[installer_id])";
            $install_update_sql = "UPDATE install SET user_id = $_POST[installer_id], seq = (SELECT seq.count FROM ".$install_seq." AS seq) + 1 WHERE id = '$value->_id'";
        } else {
            $install_update_sql = "UPDATE install SET user_id = NULL, seq = NULL WHERE id = '$value->_id'";
        }
        $result = mysqli_query($mysqli, $install_update_sql);

        echo "$install_update_sql\n";
        if ($result) {
        echo "install_update_sql 쿼리성공\n";
        } else {
        echo "install_update_sql 쿼리실패\n";
        echo mysqli_error($mysqli);
        echo "\n";
        }
    }
}

function send_branch_html($branch_result) {
    $branch_data = mysqli_fetch_array($branch_result);
    $branch_list = "";

    while ($branch_data != null) {
        $branch_list = $branch_list . "<li><button class=\"dropdown-item branch\" value=\"$branch_data[id]\">$branch_data[branch_name]</button></li>";
        $branch_data = mysqli_fetch_array($branch_result);
    }

    echo $branch_list;
}

function branch_return($mysqli, $id) {
    if ($id) {
        $branch_sql = "SELECT branch_name, id FROM branch WHERE delete_yn is null AND id = $id";
    } else {
        $branch_sql = "SELECT branch_name, id FROM branch WHERE delete_yn is null";
    }

    $branch_result = mysqli_query($mysqli, $branch_sql);

    return $branch_result;
}

function send_installer_html($installer_result)
{
    //나중에 지사정보도 받아서 앞에 (지사)홍길동 이런식으로 리턴
    $installer_data = mysqli_fetch_array($installer_result);
    $installer_data_array = array();

    while ($installer_data != null) {
        $installer_data_array[] = $installer_data;
        $installer_data = mysqli_fetch_array($installer_result);
    }

    echo json_encode($installer_data_array, JSON_UNESCAPED_UNICODE);

    //echo $installer_html;
}

function installer_return($mysqli) {
    $installer_id = $_POST['id'];

    if ($installer_id == "NULL") {
        return;
    } 

    if ($installer_id) {
        $installer_sql = "SELECT name, id FROM user WHERE delete_yn is null AND position = 2 AND id = $installer_id";
    } else {
        $installer_sql = "SELECT name, id FROM user WHERE delete_yn is null AND position = 2";
    }

    $installer_result = mysqli_query($mysqli, $installer_sql);

    return $installer_result;
}

function install_array_return($install_result) {
    $install_data_array = array();
    $install_data = mysqli_fetch_array($install_result);

    while ($install_data != null) {
        $install_data_array[] = $install_data;
        $install_data = mysqli_fetch_array($install_result);
    }

    return $install_data_array;
}

function send_install_list_data($mysqli, $installer_result) {
    $installer_data = mysqli_fetch_array($installer_result);
    $installer_id = $installer_data['id'];
    $region_sub_sql = "(SELECT region FROM region WHERE spot.region_id = region.id) AS region";

    if ($installer_id) {
        $install_sql = "SELECT install_spot_id, user_id, install.id AS id, delete_yn, type, complete, spot.address_2 AS address, " . $region_sub_sql . "
            FROM install 
            JOIN install_spot AS spot ON spot.id = install.install_spot_id 
            WHERE delete_yn is null AND user_id = $installer_id ORDER BY seq";
    } else {
        $install_sql = "SELECT install_spot_id, user_id, install.id AS id, delete_yn, type, complete, spot.address_2 AS address, " . $region_sub_sql . "
            FROM install 
            JOIN install_spot AS spot ON spot.id = install.install_spot_id 
            WHERE delete_yn is null AND user_id is null ORDER BY seq";
        $installer_id = "NULL";
    }

    $install_result = mysqli_query($mysqli, $install_sql);
    $install_data_array[$installer_id] = install_array_return($install_result);

    echo json_encode($install_data_array, JSON_UNESCAPED_UNICODE);
    //print_r($install_data_array);
}

function set_user_branch($mysqli) {
    $user_branch_sql = "UPDATE user SET branch_id = $_POST[branch_id] WHERE id = '$_POST[user_id]'";
    $user_branch_result = mysqli_query($mysqli, $user_branch_sql);

    echo "$user_branch_sql\n";
    if ($user_branch_result) {
    echo "user_branch_sql 쿼리성공\n";
    } else {
    echo "user_branch_sql 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
    }
}

function install_seq_update($mysqli) {
    $pre_install_seq_sql = " UPDATE install
    SET seq = CASE
        WHEN seq = $_POST[pre_seq] THEN $_POST[seq]
        WHEN seq = $_POST[seq] THEN $_POST[pre_seq]
        END
    WHERE user_id = '$_POST[installer_id]' AND seq IN ($_POST[pre_seq], $_POST[seq]);";
    $pre_install_seq_result = mysqli_query($mysqli, $pre_install_seq_sql);

    echo "$pre_install_seq_sql\n";
    if ($pre_install_seq_result) {
    echo "pre_install_seq_sql 쿼리성공\n";
    } else {
    echo "pre_install_seq_sql 쿼리실패\n";
    echo mysqli_error($mysqli);
    echo "\n";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['key_auth']) {
        case 1:
            echo "여기왔냐";
            user_auth_update($mysqli);
            break;
    }
    
    switch ($_POST['key_branch']) {
        case 1:
            branch_insert_or_delete($mysqli);
            break;
        case 2:
            send_branch_html(branch_return($mysqli, 0));
            break;
    }
    
    switch ($_POST['key_install']) {
        case 1:
            send_installer_html(installer_return($mysqli));
            break;
        case 2:
            send_install_list_data($mysqli, installer_return($mysqli));
            break;
        case 3:
            install_update($mysqli);
            break;
        case 4:
            install_seq_update($mysqli);
            break;
    }
    /*
    switch ($_POST['key']) {
        case 0:
            user_auth_update($mysqli);
            break;
        case 1:
            branch_insert_or_delete($mysqli);
            break;
        case 2:
            send_branch_html(branch_return($mysqli, 0));
            break;
        case 3:
            send_installer_html(installer_return($mysqli));
            break;
        case 4:
            send_install_list_data($mysqli, installer_return($mysqli));
            break;
        case 5:
            set_user_branch($mysqli);
            break;
        case 6:
            install_update($mysqli);
            break;
        case 7:
            install_seq_update($mysqli);
            break;
    }*/
    

} else {
  echo "잘못된 접근입니다.\n";
}

?>