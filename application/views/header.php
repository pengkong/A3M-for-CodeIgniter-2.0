<div id="header">
	<div class="container_12">
        <div class="grid_8">
            <h1><?php echo anchor('', lang('website_title')); ?></h1>
        </div>
        <div class="grid_4">
            <ul id="top_menu">
                <?php if ($this->authentication->is_signed_in()) : ?>
                <li><?php echo sprintf(lang('website_welcome_username'), '<strong>'.$account->username.'</strong>'); ?></li>
                <li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
                <li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
                <?php else : ?>
                <li><?php echo anchor('account/sign_up', lang('website_sign_up')); ?></li>
                <li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>