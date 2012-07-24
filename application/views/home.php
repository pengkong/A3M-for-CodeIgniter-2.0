<!DOCTYPE html>
<html>
<head>
<title><?php echo $this->lang->line('website_title'); ?></title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<base href="<?php echo base_url(); ?>" />

<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<link type="text/css" rel="stylesheet" href="resource/css/960gs/960gs.css" />
<link type="text/css" rel="stylesheet" href="resource/css/style.css" />

</head>
<body>

	<?php echo $this->load->view('header'); ?>
	<div id="content">
		<div class="container_12">
			<div class="grid_12">
			
				<b>Nothing here until you edit:</b>
				<code>/applications/views/home.php</code>
				
				<b>For style changes, edit:</b>
				<code>/resource/css/style.css</code>
				
				<p>If you like this project, please help contribute with <b>bug fixes &amp; enhancements</b> at <a href="https://github.com/pengkong/A3M-for-CodeIgniter-2.0">https://github.com/pengkong/A3M-for-CodeIgniter-2.0</a>.</p>
				
				
			</div>			
			<div class="clear"></div>
		</div>
	</div>
	<?php echo $this->load->view('footer'); ?>

</body>
</html>