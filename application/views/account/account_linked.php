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


<?php if ($num_of_linked_accounts == 0) : ?>
    <div class="alert alert-error">
	<?php echo lang('linked_no_linked_accounts'); ?>
    </div>

	<?php else : ?>
	<?php if ($facebook_links) : ?>
		<?php foreach ($facebook_links as $facebook_link) : ?>

	    <div class="clearfix">
		<div class="col-lg-1">
		    <img src="<?php echo base_url(RES_DIR);?>/img/auth_icons/facebook.png" alt="<?php echo lang('connect_facebook'); ?>"
			 title="<?php echo lang('connect_facebook'); ?>" width="40"/>
		</div>
		<div class="col-lg-9">
			<strong><?php echo lang('connect_facebook'); ?></strong><br/>
			<?php echo anchor('http://facebook.com/profile.php?id='.$facebook_link->facebook_id, substr('http://facebook.com/profile.php?id='.$facebook_link->facebook_id, 0, 30).(strlen('http://facebook.com/profile.php?id='.$facebook_link->facebook_id) > 30 ? '...' : ''), array('target' => '_blank', 'title' => 'http://facebook.com/profile.php?id='.$facebook_link->facebook_id)); ?>
		</div>
		<div class="col-lg-2">
			<?php if ($num_of_linked_accounts >= 1 && isset($account->password)) : ?>
			<?php echo form_open(uri_string()); ?>
			<?php echo form_fieldset(); ?>
			<?php echo form_hidden('facebook_id', $facebook_link->facebook_id); ?>
			<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-default', 'content' => '<i class="glyphicon glyphicon-trash"></i> '.lang('linked_remove'))); ?>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
			<?php endif; ?>
		</div>
	    </div>

		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ($twitter_links) : ?>
		<?php foreach ($twitter_links as $twitter_link) : ?>
	    <div class="clearfix">
		<div class="col-lg-1">
		    <img src="<?php echo base_url(RES_DIR);?>/img/auth_icons/twitter.png" alt="<?php echo lang('connect_twitter'); ?>" title="<?php echo lang('connect_twitter'); ?>"
			 width="40"/>
		</div>
		<div class="col-lg-9">
			<strong><?php echo lang('connect_twitter'); ?></strong><br/>
			<?php echo anchor('http://twitter.com/'.$twitter_link->twitter->screen_name, substr('http://twitter.com/'.$twitter_link->twitter->screen_name, 0, 30).(strlen('http://twitter.com/'.$twitter_link->twitter->screen_name) > 30 ? '...' : ''), array('target' => '_blank', 'title' => 'http://twitter.com/'.$twitter_link->twitter->screen_name)); ?>
</div>
<div class="col-lg-2">
			<?php if ($num_of_linked_accounts >= 1 && isset($account->password)) : ?>
			<?php echo form_open(uri_string()); ?>
			<?php echo form_fieldset(); ?>
			<?php echo form_hidden('twitter_id', $twitter_link->twitter_id); ?>
			<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-default', 'content' => '<i class="glyphicon glyphicon-trash"></i> '.lang('linked_remove'))); ?>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
			<?php endif; ?>
		</div>
	    </div>
		<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if ($linkedin_links) : ?>
		<?php foreach ($linkedin_links as $linkedin_link) : ?>
	    <div class="clearfix">
		<div class="col-lg-1">
		    <img src="<?php echo base_url(RES_DIR);?>/img/auth_icons/linkedin.png" alt="<?php echo lang('connect_linkedin'); ?>" title="<?php echo lang('connect_linkedin'); ?>"
			 width="40"/>
		</div>
		<div class="col-lg-9">
			<strong><?php echo lang('connect_linkedin'); ?></strong><br/>
			<?php echo anchor('http://www.linkedin.com/profile/view?id='.$linkedin_link->linkedin_id, substr('http://www.linkedin.com/profile/view?id='.$linkedin_link->linkedin_id, 0, 30).(strlen('http://www.linkedin.com/profile/view?id='.$linkedin_link->linkedin_id) > 30 ? '...' : ''), array('target' => '_blank', 'title' => 'http://www.linkedin.com/profile/view?id='.$linkedin_link->linkedin_id)); ?>
</div>
<div class="col-lg-2">
			<?php if ($num_of_linked_accounts >= 1 && isset($account->password)) : ?>
			<?php echo form_open(uri_string()); ?>
			<?php echo form_fieldset(); ?>
			<?php echo form_hidden('linkedin_id', $linkedin_link->linkedin_id); ?>
			<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-default', 'content' => '<i class="glyphicon glyphicon-trash"></i> '.lang('linked_remove'))); ?>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
			<?php endif; ?>
		</div>
	    </div>
		<?php endforeach; ?>
	<?php endif; ?>
	

	<?php if ($openid_links) : ?>
		<?php foreach ($openid_links as $openid_link) : ?>

	    <div class="clearfix">
		<div class="col-lg-1">
		    <img src="<?php echo base_url(RES_DIR);?>/img/auth_icons/<?php echo $openid_link->provider; ?>.png" alt="<?php echo lang('connect_'.$openid_link->provider); ?>" width="40"/>
		</div>
		<div class="col-lg-9">
		    <strong><?php echo lang('connect_'.$openid_link->provider); ?></strong><br/>
			<?php echo anchor($openid_link->openid, substr($openid_link->openid, 0, 30).(strlen($openid_link->openid) > 30 ? '...' : ''), array('target' => '_blank', 'title' => $openid_link->openid)); ?>
		</div>
		<div class="col-lg-2">
			<?php if ($num_of_linked_accounts >= 1 && isset($account->password)) : ?>
			<?php echo form_open(uri_string()); ?>
			<?php echo form_fieldset(); ?>
			<?php echo form_hidden('openid', $openid_link->openid); ?>
			<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-default', 'content' => '<i class="glyphicon glyphicon-trash"></i> '.lang('linked_remove'))); ?>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
			<?php endif; ?>
		</div>
	    </div>

			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>

    <br/>

    <h3 class="clearfix"><?php echo lang('linked_link_with_your_account_from'); ?></h3>
    <ul class="third_party">
	<?php foreach ($this->config->item('third_party_auth_providers') as $provider) : ?>
		<li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, ' ', array('title' => sprintf(lang('connect_with_x'), lang('connect_'.$provider)))); ?></li>
	<?php endforeach; ?>
    </ul>