<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo sprintf(lang('connect_with_x'), lang('connect_openid')); ?></title>
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
            <h2><?php echo anchor(current_url(), sprintf(lang('connect_with_x'), lang('connect_openid'))); ?></h2>
        </div>
        <div class="clear"></div>
        <div class="grid_6">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <h3><?php echo sprintf(lang('connect_enter_your'), lang('connect_openid_url')); ?> 
                <small><?php echo anchor($this->config->item('openid_what_is_url'), lang('connect_start_what_is_openid'), array('target'=>'_blank')); ?></small></h3>
            <?php if (isset($connect_openid_error)) : ?>
            <div class="grid_6 alpha">
                <div class="form_error"><?php echo $connect_openid_error; ?></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('connect_openid_error')) : ?>
            <div class="grid_6 alpha">
                <div class="form_error"><?php echo $this->session->flashdata('connect_openid_error'); ?></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <div class="grid_6 alpha">
                <?php echo form_input(array(
                        'name' => 'connect_openid_url',
                        'id' => 'connect_openid_url',
                        'class' => 'openid',
                        'value' => set_value('connect_openid_url')
                    )); ?>
                <?php echo form_error('connect_openid_url'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_6 alpha">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'button',
                        'content' => lang('connect_proceed')
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