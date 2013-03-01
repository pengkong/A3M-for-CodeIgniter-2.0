# [A3M (Account Authentication & Authorization)] (https://github.com/donjakobo/A3M/)
_2/25/2013 - Currently some code is semi-stable, please fork and help squash bugs/update views_

A CodeIgniter 2.x package that leverages bleeding edge web technologies like OpenID and OAuth to create a user-friendly user experience. It gives you the CRUD to get working right away without too much fuss! A3M is a full package meant for building websites from scratch without all that tiresome login / logout / admin stuff thats always required.

## Authors

**Jakub**   			
+ [@kubanishku](https://twitter.com/kubanishku/) on Twitter    
+ [@donjakobo](https://github.com/donjakobo) on GitHub   
	
**PengKong**   
+ [@pengkong](https://github.com/pengkong) on Github   
		
## Key Features & Design Goals

See our **[app task board on Trello](https://trello.com/board/a3m/512c08b874b855f26200e690)** to get a glimps of to-do items

* Native Sign Up, Sign In with 'Remember me' and Sign Out  
* Native account Forgot Password and Reset Password  
* Facebook/Twitter/Google/Yahoo/OpenID Sign Up, Sign In and Sign Out  
* Manage Account Details, Profile Details and Linked Accounts  
* reCAPTCHA Support, SSL Support, Language Files Support  
* Create a painless user experience for sign up and sign in  
* Create code that is easily understood and re-purposed  
* Utilize Twitter Bootstrap (a fantastic CSS / JS library)  
* Graceful degradation of JavaScript and CSS  
* Proper usage of CodeIgniter's libraries, helpers and plugins  
* Easily Configurable via config file  

## Folder structure  

* `/application/` - what you should be editing / creating in    
* `/system/` - default CodeIgniter system folder (don't touch!)   
* `/resource/` - css / images / javascript (folder configurable via `constants.php`)   
* `/user_guide/` - latest guide for CI (can be deleted, just for CI reference)

## 3rd Party Libraries & Plugins

* [recaptcha_pi.php](http://code.google.com/p/recaptcha/) - recaptcha-php-1.11
* [facebook_pi.php](https://github.com/facebook/facebook-php-sdk/) - v.3.2.2 
* [twitter_pi.php](https://github.com/jmathai/twitter-async) - Updated to latest release - [Jun 11, 2011](https://github.com/jmathai/twitter-async/commits/master)  
* [phpass_pi.php](http://www.openwall.com/phpass/) - Version 0.3 / genuine _(latest)_ 
* [openid_pi.php](http://sourcecookbook.com/en/recipes/60/janrain-s-php-openid-library-fixed-for-php-5-3-and-how-i-did-it) - php-openid-php5.3  

## Dependencies

* CURL
* DOM or domxml 
* GMP or Bcmatch

## Installation Instructions

+ Download the latest version of [A3M](https://github.com/donjakobo/A3M/)
+ Extract to a folder accessible on your webserver (`/` or something like `/a3m/` )  
+ Create a database by importing `a3m_database.sql` script found it root folder of package  
+ Configure `/applicaion/config/config.php` & `database.php` to match your CI setup (domain + database credentials)  
+ Modify `.htaccess` file if your app location is different than `/` (example: `domain.com/a3m/`)  
+ Configure `/applicaion/config/account/*` files to reflect your setup (reCAPTCHA, twitter, facebook, openid providers, etc;)

## Note
+ The current codebase is _unstable_ due to a large re-write effort of the original application. Some controllers/views may need to be updated to work correctly. Please fork and help out!
+ Note that twitter doesn't work if your base url is `localhost` and facebook won't work if your base url is `127.0.0.1`. Therefore ensure that your base url is something like `yoursite.com`. One way to do that is to simply [map the hostname](http://en.wikipedia.org/wiki/Hosts_%28file%29) your want to `127.0.0.1` on your development machine.
Your twitter callback URL should take into account whether or not you have enabled SSL in your a3m config   
 + `https://domain.com/account/connect_twitter` (SSL **Enabled**) 
 + `http://domain.com/account/connect_twitter` (SSL Disabled) 

Configuring this wrongly will result in an `EpiOAuthUnauthorizedException` exception being thrown.

