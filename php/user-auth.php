<?php
include "./db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    $table_data = json_decode($_POST['table_data_array']);
    echo "테스트\n";
    
    foreach($table_data as $key => $value) {
        if($_POST['jud']) {
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
        }*/
    }

} else {
  echo "잘못된 접근입니다.\n";
}

?>