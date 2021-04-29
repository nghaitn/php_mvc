<?php include_once('header.php'); ?>
 
<?php
 
$sql = "SELECT * FROM tb_user WHERE level = 2";
$users = db_get_list($sql);

?>
 
<h1>List Customer</h1>

<table cellspacing="0" cellpadding="0" class="form">
    <thead>
        <tr>
            <td>Name</td>
            <td>Email</td>
            <?php if (is_admin()){ ?>
				<td>Action</td>
			<?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $item){ ?>
			<tr>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['email']; ?></td>
				<?php if (is_admin()){ ?>
				<td>
					<form method="POST" class="form-delete" action="<?php echo base_url('?action=delete'); ?>">
						<a href="<?php echo base_url('?action=edit&id='); ?><?php echo $item['id']; ?>">Edit</a>
						<input type="hidden" name="user_id" value="<?php echo $item['id']; ?>"/>
						<input type="hidden" name="request_name" value="delete_user"/>
						<input type="submit" name="delete_user" value="Delete"/>
					</form>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
    </tbody>
</table>
 
 
<?php include_once('footer.php'); ?>