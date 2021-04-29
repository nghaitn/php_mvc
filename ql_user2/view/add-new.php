
<?php 

$error = array();
 
if (is_submit('add_user'))
{
    $data = array(
        'name'  => input_post('name'),
        'email'     => input_post('email'),
		'created_date'     => date( 'Y-m-d H:i:s' ),
		'updated_date'     => date( 'Y-m-d H:i:s' ),
        'level'     => 2,
    );
     
    $error = db_user_validate($data);
     
    if (!$error)
    { 
        if (db_insert('tb_user', $data)){
            ?>
            <script language="javascript">
                alert('Add new user success!');
                window.location = '<?php echo base_url("?action=add-new"); ?>';
            </script>
            <?php
            die();
        }
    }
}
?>
 
<?php include_once('header.php'); ?>
 
<h1>Add Customer</h1>
 
<form id="main-form" method="post" action="<?php echo base_url('?action=add-new'); ?>">
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Name</td>
            <td>
                <input type="text" name="name" value="<?php echo input_post('name'); ?>" />
                <?php show_error($error, 'name'); ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" name="email" value="<?php echo input_post('email'); ?>" class="long" />
                <?php show_error($error, 'email'); ?>
            </td>
        </tr>
		<tr>
            <td></td>
            <td>
                <input type="submit" name="submit_add" value="Add" class="add_user" />
            </td>
        </tr>
    </table>
	<input type="hidden" name="request_name" value="add_user"/>
	
</form>
 
<?php include_once('footer.php'); ?>