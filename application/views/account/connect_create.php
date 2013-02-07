<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo lang('connect_create_account'); ?></title>
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
            <h2><?php echo anchor(current_url(), lang('connect_create_account')); ?></h2>
        </div>
        <div class="clear"></div>
        <div class="grid_6">
            <?php echo form_open(uri_string()); ?>
			<?php echo form_fieldset(); ?>
            <h3><?php echo lang('connect_create_heading'); ?></h3>
            <?php if (isset($connect_create_error)) : ?>
            <div class="grid_6 alpha">
                <div class="form_error"><?php echo $connect_create_error; ?></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('connect_create_username'), 'connect_create_username'); ?>
            </div>
            <div class="grid_4 omega">
                <?php echo form_input(array(
                        'name' => 'connect_create_username',
                        'id' => 'connect_create_username',
                        'value' => set_value('connect_create_username') ? set_value('connect_create_username') : (isset($connect_create[0]['username']) ? $connect_create[0]['username'] : ''),
                        'maxlength' => '16'
                    )); ?>
                <?php echo form_error('connect_create_username'); ?>
                <?php if (isset($connect_create_username_error)) : ?>
                <span class="field_error"><?php echo $connect_create_username_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('connect_create_email'), 'connect_create_email'); ?>
            </div>
            <div class="grid_4 omega">
                <?php echo form_input(array(
                        'name' => 'connect_create_email',
                        'id' => 'connect_create_email',
                        'value' => set_value('connect_create_email') ? set_value('connect_create_email') : (isset($connect_create[0]['email']) ? $connect_create[0]['email'] : ''),
                        'maxlength' => '160'
                    )); ?>
                <?php echo form_error('connect_create_email'); ?>
                <?php if (isset($connect_create_email_error)) : ?>
                <span class="field_error"><?php echo $connect_create_email_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="prefix_2 grid_4 alpha">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'button',
                        'content' => lang('connect_create_button')
                    )); ?>
            </div>
            <div class="clear"></div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>
</body>
</html>