<!DOCTYPE html>
<html<?php language_attributes(); ?>>
    <head>
        <meta charset="<?php app_info( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title><?php echo ( isset( $title ) ? $title . ( defined( 'TITLE_SEPARATOR' ) ? TITLE_SEPARATOR : '' ) : '' ) . get_app_info( 'app_name' ); ?></title>

        <link rel="apple-touch-icon" sizes="180x180" href="<?php app_info( 'assets_directory' ); ?>favicons/apple-touch-icon.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon-32x32.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="194x194" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon-194x194.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php app_info( 'assets_directory' ); ?>favicons/android-chrome-192x192.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon-16x16.png?v=qAqGWwBKv7">
        <link rel="manifest" href="<?php app_info( 'assets_directory' ); ?>favicons/manifest.json?v=qAqGWwBKv7">
        <link rel="mask-icon" href="<?php app_info( 'assets_directory' ); ?>favicons/safari-pinned-tab.svg?v=qAqGWwBKv7" color="#e91e63">
        <link rel="shortcut icon" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon.ico?v=qAqGWwBKv7">
        <meta name="apple-mobile-web-app-title" content="<?php app_info( 'app_name' ); ?>">
        <meta name="application-name" content="<?php app_info( 'app_name' ); ?>">
        <meta name="msapplication-TileColor" content="#263238">
        <meta name="msapplication-TileImage" content="<?php app_info( 'assets_directory' ); ?>favicons/mstile-144x144.png?v=qAqGWwBKv7">
        <meta name="msapplication-config" content="<?php app_info( 'assets_directory' ); ?>favicons/browserconfig.xml?v=qAqGWwBKv7">
        <meta name="theme-color" content="#263238">

        <style type="text/css">
            <!--
            @import url('<?php app_info( 'assets_directory' ); ?>fonts/font-awesome/css/font-awesome.min.css');
            @import url('<?php app_info( 'stylesheet_url' ); ?>');
            -->
        </style>
    </head>
    <body id="<?php echo ( isset( $page_id ) ? $page_id : 'default' ); ?>">
        <header role="banner">
            <a id="primary-logo" href="<?php app_info( 'home' ); ?>" title="<?php app_info( 'app_name' ); ?>"><img alt="<?php app_info( 'app_name' ); ?>" class="logo svg" data-svg="" src="<?php app_info( 'assets_directory' ); ?>images/logo_default.png"><span id="site-title"><?php app_info( 'app_name' ); ?></span></a>
            <nav id="primary-nav">
                <ul class="menus" id="primary-menu">
                    <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'home' ) ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'home' ); ?>" title="Accueil">Accueil</a></li>
                    <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'home' ) ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'home' ); echo "conversation"; ?>" title="conversation">Conversation</a></li>
                </ul>
            </nav>
        </header>

        <main role="main">