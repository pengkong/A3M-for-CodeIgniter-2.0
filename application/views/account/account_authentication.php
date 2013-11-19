<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => lang('sign_up_email_subject'))); ?>
</head>
<body>
<?php echo $this->load->view('header'); ?>
<div class="container">
    <div class="row">
        <div class="span12">
	    <?php echo lang('sign_up_validation'); ?>
        </div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>
</body>
</html>