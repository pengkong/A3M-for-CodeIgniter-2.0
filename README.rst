A3M (Account Authentication & Authorization) is a CodeIgniter 2.x package that leverages bleeding edge web 
technologies like OpenID and OAuth to create a user-friendly user experience. It gives you the CRUD to get working
right away without too much fuss! A3M is a full package meant for building websites from scratch without all that
tiresome login / logout / admin stuff thats always required.

Download and Fork at:
=====================================
==       https://github.com/donjakobo/A3M/		  ==
=====================================	

Key Features & Design Goals
======================

 -  Native Sign Up, Sign In with 'Remember me' and Sign Out
 -  Native account Forgot Password and Reset Password
 -  Facebook/Twitter/Google/Yahoo/OpenID Sign Up, Sign In and Sign Out
 -  Manage Account Details, Profile Details and Linked Accounts
 -  reCAPTCHA Support, SSL Support, Language Files Support
 -  Create a painless user experience for sign up and sign in
 -  Create code that is easily understood and re-purposed
 -  Utilize Twitter Bootstrap (a fantastic CSS / JS library)
 -  Graceful degradation of JavaScript and CSS
 -  Adhere to security best practices
 -  Proper usage of CodeIgniter's libraries, helpers and plugins
 -  Optimal performance by minimizing autoloading
 -  Easily Configurable via config file

Folder structure
======================

 -  /application/ - what you should be editing in  
 -  /system/ - default CodeIgniter system folder  
 -  /resource/ - keeps external resources like css / images / javascript  
 -  /user_guide/ - latest 2.1.2 guide for CI  

3rd party libraries used
======================
@TODO: Add referencing libraries here

Plugins
======================

@TODO: Update this list below: ------v

 -  recaptcha_pi.php - http://code.google.com/p/recaptcha/ recaptcha-php-1.11
 -  facebook_pi.php - https://github.com/facebook/php-sdk/
 -  twitter_pi.php - https://github.com/jmathai/twitter-async
 -  phpass_pi.php - http://www.openwall.com/phpass/ phpass-0.2
 -  openid_pi.php - http://sourcecookbook.com/en/recipes/60/janrain-s-php-openid-library-fixed-for-php-5-3-and-how-i-did-it php-openid-php5.3

Installation Instructions
======================

1. Download the latest version of A3M 
2. Extract to a folder accessible on your webserver (say /a3m/ )
3. Create a database using the 'a3m_database.sql' script found it root folder of package
4. Modify /applicaion/config/config.php & /applicaion/config/database.php to match your setup (folder path + database credentials)
5. Modify your .htaccess file IF your default folder is different from /a3m/ (example: domain.com/a3m/)
6. Note that twitter doesn't work if your base url is 'localhost' and facebook doesn't work if your base url is '127.0.0.1'. Therefore ensure that your base url is something like 'yoursite.com'. One way to do that is to simply map the hostname your want to 127.0.0.1 on your development machine. (reference: http://en.wikipedia.org/wiki/Hosts_%28file%29)
7. Configure your external OpenID providers in /application/config/account/*

Your twitter callback URL should take into account whether or not you have enabled SSL in your a3m config 
https://a3m.mushmellow.com/a3m_mushmellow/account/connect_twitter (SSL Enabled) 
http://a3m.mushmellow.com/a3m_mushmellow/account/connect_twitter (SSL Disabled) Configuring this wrongly will result in an 'EpiOAuthUnauthorizedException' exception being thrown.


Developed by
======================

	Jakub 			
		https://twitter.com/kubanishku/
		https://github.com/donjakobo				
	
	PengKong 
		https://github.com/pengkong
		
		