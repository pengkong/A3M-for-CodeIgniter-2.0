<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
</head>
<body>
<p><?php echo sprintf(lang('users_creation_email_intro'), base_url()); ?></p>
<p>
    <ul>
        <li><?php echo lang('users_username') . ": " . $username; ?></li>
        <li><?php echo lang('users_password_temp') . ": " . $password; ?></li>
    </ul>
</p>
<p><?php echo lang('users_creation_email_end'); ?></p>
</body>
</html>