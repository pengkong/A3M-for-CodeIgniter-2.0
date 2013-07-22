<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
			<?php echo anchor('', lang('website_title'), 'class="brand"'); ?>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="divider-vertical"></li>
                    <li><?php echo anchor('', 'Nav Link 1'); ?></li>
                    <li><?php echo anchor('', 'Nav Link 2'); ?></li>
                </ul>

                <ul class="nav pull-right">
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php if ($this->authentication->is_signed_in()) : ?>
                        	<i class="icon-user icon-white"></i> <?php echo $account->username; ?> <b class="caret"></b></a>
						<?php else : ?>
                        	<i class="icon-user icon-white"></i> <b class="caret"></b></a>
						<?php endif; ?>

                        <ul class="dropdown-menu">
							<?php if ($this->authentication->is_signed_in()) : ?>
                                <li class="nav-header">Account Info</li>
								<li><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
								<li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
								<?php if ($account->password) : ?>
									<li><?php echo anchor('account/account_password', lang('website_password')); ?></li>
								<?php endif; ?>
								<li><?php echo anchor('account/account_linked', lang('website_linked')); ?></li>    
                                <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
                                    <li class="divider"></li>
                                    <li class="nav-header">Admin Panel</li>
                                    <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
                                        <li><?php echo anchor('account/manage_users', lang('website_manage_users')); ?></li>
                                    <?php endif; ?>

                                    <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
                                        <li><?php echo anchor('account/manage_roles', lang('website_manage_roles')); ?></li>
                                    <?php endif; ?>

                                    <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
                                        <li><?php echo anchor('account/manage_permissions', lang('website_manage_permissions')); ?></li>
                                    <?php endif; ?>
                                <?php endif; ?>

								<li class="divider"></li>
								<li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
							<?php else : ?>
								<li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
							<?php endif; ?>

                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
