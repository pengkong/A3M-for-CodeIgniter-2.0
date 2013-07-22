<!DOCTYPE html>
<html>
<head>
    <?php echo $this->load->view('head', array('title' => lang('reset_password_page_name'))); ?>
</head>
<body>
<?php echo $this->load->view('header'); ?>
<div class="container">
    <div class="row">
        <div class="span12">
            <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

            <p><?php echo lang('reset_password_unsuccessful'); ?></p>

            <p><?php echo anchor('account/forgot_password', lang('reset_password_resend'), array('class' => 'btn')); ?></p>
        </div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>
</body>
</html>