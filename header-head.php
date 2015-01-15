<?php
/**
 * The `head` tag for our theme.
 *
 * Displays only the <head> section
 *
 * @package Planview Enterprise 11.3
 */
?><!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="no-js lt-ie10 lt-ie9"><![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 9]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
