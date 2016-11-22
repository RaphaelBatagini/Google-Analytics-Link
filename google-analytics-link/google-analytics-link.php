<?php
/*
Plugin Name:Google Analytics Link
Plugin URI:http://www.brainmade.com.br
Description:Plugin created to help add the analytics link at the bottom of the page
Author:Raphael H. Batagini
Version:1.0
Author URI:raphabatagini@gmail.com
*/

    define('BASE_DIRECTORY', '/google-analytics-link');
    
    /**********************************************************************/
    /********************* CREATING MENU AND SUB MENU *********************/
    /**********************************************************************/

    function menu()
    {
        add_menu_page('About The Plugin', 'Google Analytics Link', 'manage_options', BASE_DIRECTORY . '/about.php');
        add_submenu_page(BASE_DIRECTORY . '/about.php', 'Configurations', 'Configurations', 'manage_options', BASE_DIRECTORY . '/config.php');
    }
    
    //call function menu when run admin_menu
    add_action('admin_menu', 'menu');
    
    /*****************************************************************************/
    /********************* END OF CREATING MENU AND SUB MENU *********************/
    /*****************************************************************************/
    
    
    
    /****************************************************************/
    /********************* WORKING WITH ACTIONS *********************/
    /****************************************************************/
    
    //call function when init admin
    add_action( 'admin_init', 'update_ga_tracking_code' );
    
    function update_ga_tracking_code()
    {
        register_setting('google-analytics-tracking-info', 'ga_tracking_code');
    }
    
    //adding analytics link to the footer
    function add_ga_link_footer() {
        $code = get_option('ga_tracking_code');
        if ($code) {
            echo "<script>
                      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
                      ga('create', '$code', 'auto');
                      ga('send', 'pageview');  
                  </script>";
        }
    }
    
    add_action('wp_footer', 'add_ga_link_footer', 10);
    
    /***********************************************************************/
    /********************* END OF WORKING WITH ACTIONS *********************/
    /***********************************************************************/
    
    
    /****************************************************************/
    /********************* WORKING WITH FILTERS *********************/
    /****************************************************************/
    
    //add regards at the bottom of the post content
    function post_content_regards( $content )
    {
        return $content . '<br/><small>Até a próxima!</small>';
    }
    
    //add post thanks message at the bottom of the post content
    function post_content_thanks_message( $content )
    {
        return $content . '<br/><small>Agradecemos a sua visita e o tempo dedicado a leitura e visualização de nossos conteúdos.</small>';
    }
    
    //The third param is the order. The smaller numbers first.
    add_filter('the_content', 'post_content_thanks_message', 1);
    add_filter('the_content', 'post_content_regards', 2);
    
    //add a class to the classes of post
    function custom_post_class( $classes, $class, $post_id )
    {
        array_push($classes, 'teste-' . $post_id);
        //return as array because wordpress expect classes listed as array
        return $classes;
    }
    
    //params: the element to apply the filter, the function, priority (default 10), number of params
    add_filter('post_class', 'custom_post_class', 10, 3);
    
    //removing filters example
    //remove_filter( 'the content', 'post_content_thanks_message', 1);
    
    /***********************************************************************/
    /********************* END OF WORKING WITH FILTERS *********************/
    /***********************************************************************/
    
?>
