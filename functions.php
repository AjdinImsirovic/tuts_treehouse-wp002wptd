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
add_action( 'wp_enqueue_scripts', 'wpt_theme_styles' );

// If we look at our static index.html, we can see modernizer, bootstrap, jquery, foundation, and app.js
// To port these js files, 
// first copy them into our theme - but skip jQ as WP comes with it preinstalled, and a special method if you're including JS that is dependent of jQuery
// So first copy files, and this is commit with asdfasd treeish
// Then in functions.php:
// very similar to wp_enqueue_style is the wp_enqueue_script()
// they both use the same 1st parameter, we'll also use get_template_directory_uri() and concatenate the relative path
// however, enqueue script takes additional parameters, the 3rd param is an array of dependencies, and for modernizer we'll leave it blank
// the 4th param is if we want to set the version for this, which we don't so this one is empty too
// the 5th param checks if the code goes in the header of footer. FALSE=header, TRUE=footer
// now let's add foundation
// since foundation is dependent on jquery, we'll pass it the array with jQuery, which will ensure to load jQuery before it loads foundation.js
// note that you can also make files dependent not only on jQuery but on each other
// the last param is true (display at bottom)
// now let's add main_js hook, and this one is dependent on both jquery and foundation.js, so we'll add both to the dependencies array
// and finally, say, "WordPress, when it's time for you to enqueue scripts, make sure to enqueue scripts listed in thw wpt_theme_js() custom function

function wpt_theme_js() {
  wp_enqueue_script( 'modernizr_js', get_template_directory_uri(). '/js/modernizr.js', '', '', false );
  wp_enqueue_script( 'foundation_js', get_template_directory_uri(). '/js/foundation.js', array('jquery'), '', true );
  wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/app.js', arry('jquery', 'foundation_js'), '', true );
}
add_action( 'wp_enqueue_scripts', 'wpt_theme_js' );

