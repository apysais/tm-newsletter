<?php
/**
 * Header file for the NewsLetter
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php //wp_head(); ?>
		<link
			rel="stylesheet"
			id="bootstrap4-iso-css"
			href="<?php echo TM_NEWS_PLUGIN_URL;?>assets/bootstrap-iso/bootstrap-iso.min.css?ver=<?php echo TM_NEWSLETTER_VERSION;?>"
			media="all"
		>
		<link
			rel="stylesheet"
			id="newsLetter-css"
			href="<?php echo TM_NEWS_PLUGIN_URL . 'public/css/tm-newsletter-public.css?ver='.TM_NEWSLETTER_VERSION;?>"
			media="all"
		>
	</head>
  <body <?php body_class('bootstrap-iso'); ?>>
