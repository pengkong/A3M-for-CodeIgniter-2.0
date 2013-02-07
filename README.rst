Newer Bootstrapped fork released:
========================
+ https://github.com/donjakobo/A3M

========================

A3M is a CodeIgniter 2.X package that leverages bleeding edge web technologies like OpenID and OAuth to create user-friendly user experiences for the account authentication & authorization process.

Key Features
============

1. Native Sign Up, Sign In with 'Remember me' and Sign Out
2. Native account Forgot Password and Reset Password
3. Facebook/Twitter/Google/Yahoo/OpenID Sign Up, Sign In and Sign Out
4. Manage Account Details, Profile Details and Linked Accounts
5. reCAPTCHA Support, SSL Support, Language Files Support

Design Goals
============

1. Create a painless user experience for sign up and sign in
2. Create code that is easily understood and re-purposed
3. Semantic XHTML views
4. Graceful degradation of JavaScript and CSS
5. Adhere to CodeIgniter's PHP Style Guide
6. Adhere to security best practices
7. Proper (H)MVC separation (Modular extensions by wiredesignz)
8. Proper usage of CodeIgniter's libraries, helpers and plugins
9. Optimal performance by minimizing autoloading
10. Configurable via config file

Folders
=======

1. /resource/ - keeps external resources like css / images / javascript  
2. /application/ - what you should be editing in  
3. /system/ - default CodeIgniter system folder  
4. /user_guide/ - latest 2.1.2 guide for CI  

Libraries
=========

1. https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home
    * /system/application/libraries/Controller.php
    * /system/application/libraries/Modules.php
    * /system/application/libraries/MY_Router.php
2. /system/application/libraries/MY_Session.php - Added functionality to CI_Session

Plugins
=======

* recaptcha_pi.php - http://code.google.com/p/recaptcha/ recaptcha-php-1.11
* facebook_pi.php - https://github.com/facebook/php-sdk/
* twitter_pi.php - https://github.com/jmathai/twitter-async
* phpass_pi.php - http://www.openwall.com/phpass/ phpass-0.2
* openid_pi.php - http://sourcecookbook.com/en/recipes/60/janrain-s-php-openid-library-fixed-for-php-5-3-and-how-i-did-it php-openid-php5.3

Installation
============

1. Download the latest version of A3M (https://github.com/pengkong/A3M-for-CodeIgniter-2.0)
2. Extract to a folder (default is /a3m/ )
3. Create a database using the 'a3m_database.sql' script found it root folder of package
4. Modify /applicaion/config/config.php & database.php to match your setup (folder path + database credentials)
5. Modify your .htaccess file IF your detfault folder is different from /a3m/ (example: domain.com/a3m/)
6. Note that twitter doesn't work if your base url is 'localhost' and facebook doesn't work if your base url is '127.0.0.1'. Therefore ensure that your base url is something like 'yoursite.com'. One way to do that is to simply map the hostname your want to 127.0.0.1 on your development machine. http://en.wikipedia.org/wiki/Hosts_%28file%29
7. Configure your external OpenID providers in /application/modules/account/config/*


    Your twitter callback URL should take into account whether or not you have enabled SSL in your a3m config https://a3m.mushmellow.com/a3m_mushmellow/account/connect_twitter (SSL Enabled) http://a3m.mushmellow.com/a3m_mushmellow/account/connect_twitter (SSL Disabled) Configuring this wrongly will result in an 'EpiOAuthUnauthorizedException' exception being thrown.

Note that A3M is a full package meant for building websites from scratch. If you are integrating A3M to you existing CI package you should only copy the "account" module. The required dependencies are the MY_Session and HVMC libraries and the /resource folder for css, images and javascripts.
