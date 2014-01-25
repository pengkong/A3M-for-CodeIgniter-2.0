## v2.0.0
* New feature: #78, #59, #27 HybridAuth was integrated into A3M, which means that the old socil logins no longer work.
* New feature: #30 Verify e-mail upon sign-up (can be now enabled in config).
* New feature: Default user group can be set in config.
* New feature: Added jQuery validation to sign up page.
* New feature: #74 Force user to reset password upon next sign-in
* New feature: #75 Option to send user credentials to new user created via administration
* Update: #70 Updated to Twitter Bootstrap 3.0.3
* Update: #47 Updated to CodeIgniter 3.
* Change: #70 Changed the naming structure for A3M.
* Change: #56 Removed full name and postal code from user details and DB.
* Change: Changed how views are called. Now using a template into which all views are inserted.

## v1.0.1
* New Feature: # First created user automatically becomes admin

## v1.0.0
* New feature: Admin panel
* New feature: #9 Changed the markup to bootstrap.
* Update: #40 Updated Twitter Bootstrap to version 2.3.2
* Update: #50 Updating social media icons.
* Update: #43 Twitter API updated to 1.1
* Update: #45 Updating jQuery to 2.0.2
* Update: #45 Fixing remaining pages for HTML5 and Bootstrap.
* Update: #18 Reformatted project style to match CI's guidelines.
* Fix: #51 Timezones table now has additional column for CodeIgniter friendly timezone format.
* Fix: #29 XSS on forgot password, also added missing validation.
* Fix: #21, #22 XSS Vulnerabilities fixed.
* Fix: #12 Removed insecure SSL configuration.
* Fix: #10 Correct twitter config & helper location.
* Fix: #8 Fixed twitter_model reference.
* Fix: #5 Fixed some wrong load->view references and included missing headers in some views.