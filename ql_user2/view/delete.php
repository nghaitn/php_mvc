<?php

if (is_submit('delete_user'))
{
    $id = (int)input_post('user_id');
    if ($id)
    {
		$sql = db_create_sql('DELETE FROM tb_user {where}', array(
			'id' => $id
		));

		if (db_execute($sql)){
			?>
			<script language="javascript">
				alert('delete success!');
				window.location = '<?php echo base_url("?action=list"); ?>';
			</script>
			<?php
		}
		else{
			?>
			<script language="javascript">
				alert('delete failed!');
				window.location = '<?php echo base_url("?action=list"); ?>';
			</script>
			<?php
		}

    }
}