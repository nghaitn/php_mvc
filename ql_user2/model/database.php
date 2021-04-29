<?php

$conn = null;
 
function db_connect(){
    global $conn;
    if (!$conn){
        $conn = mysqli_connect('localhost', 'root', '', 'ql_customer') 
                or die ('Không thể kết nối CSDL');
        mysqli_set_charset($conn, 'UTF-8');
    }
}
 
function db_close(){
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}
 
function db_get_list($sql){
    db_connect();
    global $conn;
    $data  = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}
 
function db_get_row($sql){
    db_connect();
    global $conn;
    $result = mysqli_query($conn, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
    return $row;
}
 
function db_execute($sql){
    db_connect();
    global $conn;
    return mysqli_query($conn, $sql);
}


function db_create_sql($sql, $filter = array())
{    

    $where = '';
     

    foreach ($filter as $field => $value){
        if ($value != ''){
            $value = addslashes($value);
            $where .= "AND $field = '$value', ";
        }
    }
     

    $where = trim($where, 'AND');

    $where = trim($where, ', ');
     

    if ($where){
        $where = ' WHERE '.$where;
    }
     
    return str_replace('{where}', $where, $sql);
}




function db_insert($table, $data = array())
{

    $fields = '';
    $values = '';
     
    foreach ($data as $field => $value){
        $fields .= $field .',';
        $values .= "'".addslashes($value)."',";
    }
     
    $fields = trim($fields, ',');
    $values = trim($values, ',');
     
    $sql = "INSERT INTO {$table}($fields) VALUES ({$values})";
     
    return db_execute($sql);
}

function db_update($table, $data = array())
{
    $fields = '';
    $values = '';
    $update = '';
	$id = isset($_GET['id']) ? $_GET['id'] : '';
    foreach ($data as $field => $value){
        $fields .= $field .',';
        $values .= "'".addslashes($value)."',";
		$update .= $field . '=' . "'".addslashes($value)."',";
    }
     
    $update = trim($update, ',');
     
    $sql = "UPDATE {$table} SET $update WHERE id = '$id'";
     
    return db_execute($sql);
}

function db_user_get_by_name($name){
    $name = addslashes($name);
    $sql = "SELECT * FROM tb_user where name = '{$name}'";
    return db_get_row($sql);
}


function db_user_validate($data)
{
    $error = array();
     
    if (isset($data['name']) && $data['name'] == ''){
        $error['name'] = 'Bạn chưa nhập tên đăng nhập';
    }
     
    if (isset($data['email']) && $data['email'] == ''){
        $error['email'] = 'Bạn chưa nhập email';
    }
    if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email không hợp lệ';
    }
     
    if (isset($data['password']) && $data['password'] == ''){
        $error['password'] = 'Bạn chưa nhập mật khẩu';
    }
     
    if (isset($data['password']) && isset($data['re-password']) && $data['password'] != $data['re-password']){
        $error['re-password'] = 'Mật khẩu nhập lại không đúng';
    }

    if (!($error) && isset($data['name']) && $data['name'] && isset( $_GET['action']) && $_GET['action'] !== 'edit'){
        $sql = "SELECT count(id) as counter FROM tb_user WHERE name='".addslashes($data['name'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['name'] = 'Tên đăng nhập này đã tồn tại';
        }
    }
     
    if (!($error) && isset($data['email']) && $data['email'] && isset( $_GET['action']) && $_GET['action'] !== 'edit'){
        $sql = "SELECT count(id) as counter FROM tb_user WHERE email='".addslashes($data['email'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['email'] = 'Email này đã tồn tại';
        }
    }
     
    return $error;
}