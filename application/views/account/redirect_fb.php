<div id="fb-root"></div>
<script src="//connect.facebook.net/en_US/all.js"></script>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId: '<?php echo $this->facebook_lib->fb->getAppID() ?>',
			status: true, // check login status
			cookie: true, // enable cookies to allow the server to access the session
			xfbml: true,  // parse XFBML
			//oauth: true
		});
		// Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
		// for any authentication related change, such as login, logout or session refresh. This means that
		// whenever someone who was previously logged out tries to log in again, the correct case below 
		// will be handled. 
		FB.Event.subscribe('auth.login', function(response) {
		  // Here we specify what we do with the response anytime this event occurs. 
		  if (response.status === 'connected') {
		    window.location.reload();
		  } else {
		    FB.login();
		  }
		});
	};
</script>
<?php if (!$this->facebook_lib->user) : ?>
	<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
<?php endif; ?>