<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Start php session for Yadis
session_start();

// For windows where no source of randomness is avaliable
if (PHP_OS == "WIN32" || PHP_OS == "WINNT") define('Auth_OpenID_RAND_SOURCE', NULL);

// Include the necessary RP (Relying Party) libraries
set_include_path(APPPATH.'helpers/account/php-openid-php5.3/'.PATH_SEPARATOR.get_include_path());
require_once "Auth/OpenID/Consumer.php";
require_once "Auth/OpenID/FileStore.php";
require_once "Auth/OpenID/SReg.php";
require_once "Auth/OpenID/AX.php";
require_once "Auth/OpenID/PAPE.php";


/* End of file openid_helper.php */
/* Location: ./application/helpers/account/openid_helper.php */