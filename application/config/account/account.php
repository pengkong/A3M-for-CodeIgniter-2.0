<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Global
|--------------------------------------------------------------------------
*/
$config['ssl_enabled'] 		= FALSE;
$config['sign_up_enabled'] 	= TRUE;
/*
|--------------------------------------------------------------------------
| Sign In
|--------------------------------------------------------------------------
*/
$config['sign_in_recaptcha_enabled'] 	= FALSE;
$config['sign_in_recaptcha_offset'] 	= 3;

/*
|--------------------------------------------------------------------------
| Sign Up
|--------------------------------------------------------------------------
*/
$config['sign_up_recaptcha_enabled'] 	= FALSE;
$config['sign_up_auto_sign_in'] 		= TRUE;

/*
|--------------------------------------------------------------------------
| Sign Out
|--------------------------------------------------------------------------
*/
$config['sign_out_view_enabled'] 		= TRUE;

/*
|--------------------------------------------------------------------------
| Forgot Password
|--------------------------------------------------------------------------
*/
$config['forgot_password_recaptcha_enabled'] 		= TRUE;

/*
|--------------------------------------------------------------------------
| OpenID
|--------------------------------------------------------------------------
*/
$config['openid_file_store_path'] = 'application/cache';
$config['openid_google_discovery_endpoint'] = 'http://www.google.com/accounts/o8/id';
$config['openid_yahoo_discovery_endpoint'] = 'http://www.yahoo.com/';

/*
|--------------------------------------------------------------------------
| Third Party Auth
|--------------------------------------------------------------------------
*/
$config['third_party_auth_providers'] = array('facebook', 'twitter', 'google', 'yahoo', 'openid');
$config['openid_what_is_url'] = 'http://openidexplained.com/';

/*
|--------------------------------------------------------------------------
| Password Reset
|--------------------------------------------------------------------------
|
|	password_reset_expiration		Reset password form will be valid for 30 mins (default)
|	password_reset_secret 			Reset password token salt. See https://www.grc.com/passwords.htm
|									* IMPORTANT * Do not reuse the password reset salt else where!
|	password_reset_email 			Reset password sender email
*/
$config['password_reset_expiration'] 	= 1800;
$config['password_reset_secret'] 		= '';
$config['password_reset_email'] 		= 'no-reply@a3m.com';


/* End of file account.php */
/* Location: ./application/account/config/account.php */