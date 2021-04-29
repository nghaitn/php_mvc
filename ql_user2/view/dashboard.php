<?php include_once('header.php'); ?>
<h1>Welcome to Dashboard!</h1>
<ul>
	<?php if (is_admin()){ ?><li><a href="<?php echo base_url('?action=add-new'); ?>">Add New Customer</a></li><?php } ?>
	<li><a href="<?php echo base_url('?action=list'); ?>">List Customer</a></li>
	<li><a href="<?php echo base_url('?action=logout'); ?>">Logout</a></li>
</ul>
<?php include_once('footer.php'); ?>