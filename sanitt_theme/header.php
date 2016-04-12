<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> ng-app="app">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title( '|', true, 'right' ); ?> [SAN]ITT[.de</title>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" rel="alternate" type="application/rss+xml" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php wp_enqueue_script("jquery"); ?>
		<script type="text/javascript">
			var wp_templateUrl = '<?= get_bloginfo("template_url"); ?>';
			var wp_homeUrl = '<?php echo get_home_url(); ?>';
		</script>
		<?php wp_head(); ?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

		<!--?php bloginfo('name'); ?--> <!--?php wp_title('-') ?-->
	</head>
	<body>
		<section class="header">
			<!-- <div><?php wp_list_pages(array('title_li' => '', 'exclude' => 4)); ?></div>   --> <!-- List of all Pages -->
			<main-header active-tab="<?php echo the_field('active_page'); ?>"></main-header>

		</section>