<ul class="nav nav-pills nav-stacked">

    <li class="<?php echo ($current == 'account_profile') ? 'active' : ''; ?>"><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
    <li class="<?php echo ($current == 'account_settings') ? 'active' : ''; ?>"><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
	<?php if ($account->password) : ?>
    <li class="<?php echo ($current == 'account_password') ? 'active' : ''; ?>"><?php echo anchor('account/account_password', lang('website_password')); ?></li>
	<?php endif; ?>
    <li class="<?php echo ($current == 'account_linked') ? 'active' : ''; ?>"><?php echo anchor('account/account_linked', lang('website_linked')); ?></li>

</ul>