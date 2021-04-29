<?php
// Lấy danh sách User



$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT * FROM tb_user WHERE id = $id";
$users = db_get_list($sql);



$error = array();
 
if (is_submit('update_user'))
{

    $data = array(
		'id'  => $id,
        'name'  => input_post('name'),
        'email'     => input_post('email'),
		'updated_date'     => date( 'Y-m-d H:i:s' ),
    );
     

    $error = db_user_validate($data);
     

    if (!$error)
    {
         if (db_update('tb_user', $data)){
            ?>
            <script language="javascript">
                alert('Update success!');
                window.location = '<?php echo base_url("?action=edit&id="); ?><?php echo $id ; ?>';
            </script>
            <?php
            die();
        }
    }
}
?>
 
<?php include_once('header.php'); ?>
 
<h1>Edit Customer</h1>
 
<form id="main-form" method="post" action="<?php echo base_url('?action=edit&id='); ?><?php echo $id ; ?>">
	
    <table cellspacing="0" cellpadding="0" class="form">
		<?php foreach ($users as $item){ ?>
			<tr>
				<td width="200px">Name</td>
				<td>
					<input type="text" name="name" value="<?php echo $item['name']; ?>" />
					<?php show_error($error, 'name'); ?>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="email" value="<?php echo $item['email']; ?>" class="long" />
					<?php show_error($error, 'email'); ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit_update" value="Update" class="update_user" />
				</td>
			</tr>
		<?php } ?>
    </table>
	<input type="hidden" name="request_name" value="update_user"/>
	
</form>
 
<?php include_once('footer.php'); ?>