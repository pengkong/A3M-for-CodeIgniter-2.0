<div id="main_menu">
    <div class="container_12">
        <div class="grid_12">
            <ul>
                <li<?php if ($current == 'account_settings') echo ' class="active"'; ?>><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
                <?php if ($account->password) : ?>
                <li<?php if ($current == 'account_password') echo ' class="active"'; ?>><?php echo anchor('account/account_password', lang('website_password')); ?></li>
                <?php endif; ?>
                <li<?php if ($current == 'account_profile') echo ' class="active"'; ?>><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
				<?php if ($this->config->item('third_party_auth_providers')) : ?>
				<li<?php if ($current == 'account_linked') echo ' class="active"'; ?>><?php echo anchor('account/account_linked', lang('website_linked')); ?></li>
				<?php endif; ?>
				
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>