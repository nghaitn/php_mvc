<?php
$error = array();


if (is_admin()){
    redirect(base_url('?action=dashboard'));
}

if (is_submit('login'))
{    

    $name = input_post('name');
    $password = input_post('password');
     

    if (empty($name)){
        $error['name'] = 'Bạn chưa nhập tên đăng nhập';
    }
     
    if (empty($password)){
        $error['password'] = 'Bạn chưa nhập mật khẩu';
    }
     
    if (!$error)
    {

        $user = db_user_get_by_name($name);
         
        if (empty($user)){
            $error['name'] = 'Tên đăng nhập không đúng';
        }

        else if ($user['password'] != md5($password)){
            $error['password'] = 'Mật khẩu bạn nhập không đúng';
        }
         
        if (!$error){
            set_logged($user['name'], $user['level']);
            redirect(base_url('?action=dashboard'));
        }
    }
}
 
?>
 
<?php include_once('header.php'); ?>
<h1>Login!</h1>
<form method="post" action="<?php echo base_url('?action=login'); ?>">
    <table>
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="name" value=""/>
                <?php show_error($error, 'name'); ?>
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="password" value=""/>
                <?php show_error($error, 'password'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="request_name" value="login"/>
            </td>
            <td>
                <input type="submit" name="login-btn" value="Đăng nhập"/>
            </td>
        </tr>
    </table>
</form>
<?php include_once('footer.php'); ?>