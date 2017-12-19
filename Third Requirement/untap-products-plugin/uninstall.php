<?php


/**
 * Trigger this file when uninstalling the plugin 
 * @package Untap Products Plugin
 */

if (! defined('WP_UNINSTALL_PLUGIN'))
{
	die('Hey!, you are not allowed to uninstall the plugin');	
}

//Delete all the data from the database related to the 'UnTap Products Plugin'.

//Access the database of wordpress 
global $wpdb;

//Perform the query on the database to delete all the posts with type 'Product'.
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'product'" );

//Delete all the metas related to the posts with type 'Product'.
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN ( SELECT ID FROM wp_posts )" );
