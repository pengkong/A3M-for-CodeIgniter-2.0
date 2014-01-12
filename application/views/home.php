<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="span12">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit" style="position: relative;">
                <div class="ribbon-wrapper-green">
                    <div class="ribbon-green">v1.0.1</div>
                </div>

                <h1>Welcome to <?php echo lang('website_title'); ?></h1>

                <p>
					This is the homepage for your web-app. You can use this as a starting point for creating with A3M and building the rest of your site.
                    If you like this project, please help contribute with <b>bug fixes &amp; enhancements</b> on <a href="https://github.com/donjakobo/A3M">GitHub</a>.
                </p>

                <p class="pull-right clearfix">
					<a class="btn btn-info" href="https://github.com/donjakobo/A3M/wiki"><i class="icon-info-sign icon-white"></i> Wiki</a>&nbsp;
					<a class="btn btn-primary" href="http://stackoverflow.com/questions/tagged/codeigniter-a3m"><i class="icon-comment icon-white"></i> Have questions?</a>&nbsp;
					<a class="btn btn-danger" href="https://github.com/donjakobo/A3M"><i class="icon-wrench icon-white"></i> Fork it &raquo;</a>
				</p>
            </div>

        </div>

        <div class="offset1 span5">
            <h3>How do I
                <small>customize this stuff?</small>
            </h3>

            <script src="<?php echo RES_DIR?>/bootstrap/js/holder.js"></script>
            <!-- Used for 64x64 placeholder boxes -->

            <div class="media">
                <a class="pull-left" href="#"><img class="media-object" data-src="holder.js/64x64"></a>

                <div class="media-body">
                    <h4 class="media-heading">Managing your controllers</h4>
                    <code>/applications/controllers/</code>
                </div>
            </div>

            <div class="media">
                <a class="pull-left" href="#"><img class="media-object" data-src="holder.js/64x64"></a>

                <div class="media-body">
                    <h4 class="media-heading">Managing your views</h4>
                    <code>/applications/views/</code>
                </div>
            </div>

            <div class="media">
                <a class="pull-left" href="#"><img class="media-object" data-src="holder.js/64x64"></a>

                <div class="media-body">
                    <h4 class="media-heading">Homepage changes</h4>
                    <code>/applications/views/home.php</code>
                </div>
            </div>
        </div>

        <div class="offset1 span5">
            <h3>Where are
                <small>the Images, Icons &amp; CSS ?</small>
            </h3>

            <div class="media">
                <a class="pull-left" href="#"><img class="media-object" data-src="holder.js/64x64"></a>

                <div class="media-body">
                    <h4 class="media-heading">Your stylesheets are here</h4>
                    <code>/<?php echo RES_DIR?>/css/</code>
                </div>
            </div>

            <div class="media">
                <a class="pull-left" href="#"><img class="media-object" data-src="holder.js/64x64"></a>

                <div class="media-body">
                    <h4 class="media-heading">Images live here</h4>
                    <code>/<?php echo RES_DIR?>/img/</code>
                </div>
            </div>

            <div class="media">
                <a class="pull-left" href="#"><img class="media-object" data-src="holder.js/64x64"></a>

                <div class="media-body">
                    <h4 class="media-heading">Twitter Bootstrap v2.3.2
                        <small><a href="http://getbootstrap.com/2.3.2/" title="Go-to Bootstrap site"><i class="icon-share"></i></a></small>
                    </h4>
                    <code>/<?php echo RES_DIR?>/bootstrap/</code>
                </div>
            </div>

        </div>

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>
