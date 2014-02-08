<?php if ($this->session->flashdata('linked_info')) : ?>
    <div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('linked_info'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('linked_error')) : ?>
    <div class="alert alert-warning alert-dismissable fade in">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('linked_error'); ?>
    </div>
<?php endif; ?>

    <div class="page-header">
	<h1><?php echo lang('linked_page_name'); ?></h1>
    </div>

    <div class="well"><?php echo lang('linked_page_satement'); ?></div>

    <h3><?php echo lang('linked_currently_linked_accounts'); ?></h3>

<?php if($linked_accounts == NULL) : ?>
    <div class="alert alert-warning">
	<?php echo lang('linked_no_linked_accounts'); ?>
    </div>
<?php else: ?>
    <?php $total_linked = count($linked_accounts); ?>
    <?php foreach($linked_accounts as $link): ?>
	<div class="clearfix">
	    <div class="col-lg-1">
		<img src="<?php echo base_url(RES_DIR);?>/img/auth_icons/<?php echo strtolower($link->provider); ?>.png" alt="<?php echo lang('connect_'.strtolower($link->provider)); ?>" width="40"/>
	    </div>
	    <div class="col-lg-9">
		<strong><?php echo lang('connect_'.strtolower($link->provider)); ?></strong><br/>
		<?php echo anchor($link->profile_url, substr($link->profile_url, 0, 30).(strlen($link->profile_url) > 30 ? '...' : ''), array('target' => '_blank', 'title' => $link->profile_url)); ?>
	    </div>
	    <div class="col-lg-2">
		<?php if ($total_linked >= 1 && isset($account->password)) : ?>
		<?php echo form_open(uri_string()); ?>
		<?php echo form_fieldset(); ?>
		<?php echo form_hidden('provider', $link->provider); ?>
		<?php echo form_hidden('uid', $link->provider_uid); ?>
		<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-default', 'content' => '<i class="glyphicon glyphicon-trash"></i> '.lang('linked_remove'))); ?>
		<?php echo form_fieldset_close(); ?>
		<?php echo form_close(); ?>
		<?php endif; ?>
	    </div>
	    
	</div>
    <?php endforeach; ?>
<?php endif; ?>

<br />

<h3 class="clearfix"><?php echo lang('linked_link_with_your_account_from'); ?></h3>
<?php if ($third_party_auth = $this->config->item('third_party_auth')) : ?>
    <h3><?php echo sprintf(lang('sign_up_third_party_heading')); ?></h3>
    <ul>
	<?php foreach ($third_party_auth['providers'] as $provider_name => $provider_values) : ?>
	    <?php if($provider_values['enabled']) : ?>
		<li class="third_party"><?php echo anchor('account/connect/'.$provider_name, '<img src="'.base_url(RES_DIR . '/img/auth_icons/'.strtolower($provider_name).'.png').'" alt="'.sprintf(lang('sign_up_with'), lang('connect_'.strtolower($provider_name))).'" height="64" width="64">' ); ?></li>
	    <?php endif; ?>
	<?php endforeach; ?>
    </ul>
<?php endif; ?>