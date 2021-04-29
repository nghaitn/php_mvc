<?php

function set_logged($name, $level){
    session_set('ss_user_token', array(
        'name' => $name,
        'level' => $level
    ));
}
 
function set_logout(){
    session_delete('ss_user_token');
}
 

function is_logged(){
    $user = session_get('ss_user_token');
    return $user;
}

function is_admin(){
    $user  = is_logged();
    if (!empty($user['level']) && $user['level'] == '1'){
        return true;
    }
    return false;
}

function redirect($url){
    header("Location:{$url}");
    exit();
}

function input_post($key){
    return isset($_POST[$key]) ? trim($_POST[$key]) : false;
}
 
function input_get($key){
    return isset($_GET[$key]) ? trim($_GET[$key]) : false;
}
function base_url($uri = ''){
    return 'http://localhost/ql_user2/'.$uri;
}

function is_submit($key){
    return (isset($_POST['request_name']) && $_POST['request_name'] == $key);
}
 
function show_error($error, $key){
    echo '<span style="color: red">'.(empty($error[$key]) ? "" : $error[$key]). '</span>';
}
