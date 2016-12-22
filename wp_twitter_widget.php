<?php
/*
Plugin Name: Twitter Widget
Plugin URI: http://labs.aliasproject.com/wp_twitter_widget
Description: A simple widget for Wordpress that displays the most recent tweet of a twitter account
Author: Michael Aguiar
Version: 1.0
Author URI: http://cv.michaelaguiar.com
*/ 
 
function twitter() {
    global $wp_query;
    $thePostName = $wp_query->post->post_name;

    // Your twitter username.
    $username = "username";
	
    // Prefix - some text you want displayed before your latest tweet. 
    $prefix = "";
	
    // Suffix - some text you want display after your latest tweet. (Same rules as the prefix.)
    $suffix = "";
	
    $feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";
    $twitterFeed = file_get_contents($feed);
	
    echo stripslashes($prefix) . parse_feed($twitterFeed) . stripslashes($suffix);
}

function parse_feed($feed) {
    $stepOne = explode("<content type=\"html\">", $feed);
    $stepTwo = explode("</content>", $stepOne[1]);
	
    $tweet = $stepTwo[0];
    $tweet = str_replace("&lt;", "<", $tweet);
    $tweet = str_replace("&gt;", ">", $tweet);
	
   return $tweet;
}
 
function widget_twitter($args) {
   extract($args);
   twitter();
}
 
function twitter_init() {
   register_sidebar_widget(__('Twitter'), 'widget_twitter');
}
 
add_action("plugins_loaded", "twitter_init");
?>