<?php
// S2 V2
// wpt_ is a namespacing to help give a unique name to all of our functions so that they don't get overriden or conflict with other functions with similar names, such as in plugins etc..

// wp_enqueue_style() lets us link to a style sheet for our particular theme
// the first parameter is a unique name (handle) to identify this style sheet - in this case, 'foundation_css'
// the second parameter is a link to this file, and the link is obtained by using a function, get_template_directory_uri(), to which we contactenate the '/css/foundation.css' 
// we can then add another wp_enqueue_style() to add 'normalize.css'
// we can add Google fonts on the third line of the wpt_theme_styles, instead of using @import - note that now the second parameter is a link to the google fonts website
// But simply writing this function will not generate the files that we need for this to work. We have to do another step here: 
// use the add_action() function tp tell wordpress when to enqueue those styles.
// the first parameter of add_action() is wp_enqueue_scripts - it's a hook that WP has that lets us tell WP what stylesheets and JS files to load for a given page.
// the second parameter is, again, the location, this time the location is the wpt_theme_styles() function
// HOWEVER, this still won't work. We need to add some more code to index, header and footer files to see this working.
// We'll take a small detour before that and using the same code, enqueue any JS files we need

function wpt_theme_styles() {
 wp_enqueue_style( 'foundation_css', get_template_directory_uri() . '/css/foundation.css' ); 
 wp_enqueue_style( 'normalize_css', get_template_directory_uri() . '/css/normalize.css' ); 
 wp_enqueue_style( 'normalize_css', 'http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' );
 wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}