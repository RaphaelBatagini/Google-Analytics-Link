<?php
/*
Plugin Name:Google Analytics Link
Plugin URI:http://www.brainmade.com.br
Description:Plugin created to help add the analytics link at the bottom of the page
Author:Raphael H. Batagini
Version:1.0
Author URI:raphabatagini@gmail.com
*/
    
    /**********************************************************************/
    /********************* CREATING MENU AND SUB MENU *********************/
    /**********************************************************************/

    function menu()
    {
        add_menu_page('Pagina - Teste', 'Menu Teste', 'manage_options', '/plugin-wp/about.php');
        add_submenu_page('/plugin-wp/about.php', 'Pagina - Teste', 'Submenu Teste', 'manage_options', '/plugin-wp/test.php');
    }
    
    //call function menu when run admin_menu
    add_action('admin_menu', 'menu');
    
    /*****************************************************************************/
    /********************* END OF CREATING MENU AND SUB MENU *********************/
    /*****************************************************************************/
    
    
    
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
    
    
    
    /****************************************************************/
    /********************* WORKING WITH ACTIONS *********************/
    /****************************************************************/
    
    //adding message to footer
    function add_footer_message() {
        echo '<p style="color: #fff">Adding some content to this message</p>';
    }
    add_action('wp_footer', 'add_footer_message', 10);
    
    //create a custom function
    function do_something($a, $b) {
        print_r($a);
        print_r($b);
    }
    
    $a = 'test_1';
    $b = 'test_2';

    //create a custom hook
    do_action('i_am_hook', $a, $b);
    
    //link custom hook to custom function
    add_action('i_am_hook', 'do_something', 10, 2);
    
    /***********************************************************************/
    /********************* END OF WORKING WITH ACTIONS *********************/
    /***********************************************************************/
    
?>