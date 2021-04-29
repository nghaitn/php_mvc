<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style type="text/css">
            #container{
                width: 80%;
                margin: 50px auto;
                overflow: hidden;
                background: #fff;
            }
			td,th{
				padding: 5px 10px;
			}
			#header ul{
				list-style: none;
				padding: 0;
			}
			#header ul li{
				display: inline-block;
				margin-right: 15px;
			}
        </style>
	</head>
    <body>
        <div id="container">
            <div id="header">
				<ul>
					<?php if (is_logged()){ ?>
						<li><a href="<?php echo base_url('?action=dashboard'); ?>">Dashboard</a></li>
						<?php if (is_admin()){ ?>
							<li><a href="<?php echo base_url('?action=add-new'); ?>">Add new</a></li>
						<?php } ?>
						<li><a href="<?php echo base_url('?action=list'); ?>">List Customer</a></li>
						<li><a href="<?php echo base_url('?action=logout'); ?>">Logout</a></li>
					<?php } ?>
				</ul>
				
            </div>
            <div id="content">