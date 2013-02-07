<!DOCTYPE html>
<html>
<head>
<?php echo $this->load->view('head', array('title' => sprintf(lang('connect_with_x'), lang('connect_openid'))) ); ?>	

</head>
<body>
	
<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
		<div class="span12">

            <h2><?php echo sprintf(lang('connect_with_x'), lang('connect_openid')); ?></h2>


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