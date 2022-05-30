<?php

/*
 
Plugin Name: footer
 
Plugin URI:
 
Description: Creating a footer plugin that customize your footer content 
 
Version: 1.0
 
Author: belkhoukh abdelghafour
 
Author URI: 

Text Domain: footer

*/

// require_once plugin_dir_path(__FILE__) . 'includes/mfp-functions.php';

if (!defined('ABSPATH')) {
    exit;
}
defined('ABSPATH') or die('Access denied !');




function custom_plugin_register_settings()
{

    register_setting('custom_plugin_options_group', 'email');

    register_setting('custom_plugin_options_group', 'copyright');
}
add_action('admin_init', 'custom_plugin_register_settings');

function custom_plugin_setting_page()
{

    // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' , string $icon_url = '');


    add_menu_page('Custom Plugin', ' Footer', 'manage_options', 'custom-plugin-setting', 'custom_page_html_form', plugins_url('footer/img/foot.png'));

    // custom_page_html_form is the function in which I have written the HTML for my custom plugin form.
}
add_action('admin_menu', 'custom_plugin_setting_page');

function custom_page_html_form()
{ ?>
    <div class="wrap">
        <h2>My Footer Plugin Setting</h2>
        <p>Here you can customize the footer content</p>
        <form method="post" action="options.php">
            <?php settings_fields('custom_plugin_options_group'); ?>

            <table class="form-table">

                <tr>
                    <th><label for="first_field_id">Enter Your E-mail:</label></th>

                    <td>
                        <input type='text' class="regular-text" id="first_field_id" name="email" value="<?php echo get_option('email'); ?>">
                    </td>
                </tr>

                <tr>
                    <th><label for="second_field_id">Enter Your Copyright:</label></th>
                    <td>
                        <input type='text' class="regular-text" id="second_field_id" name="copyright" value="<?php echo get_option('copyright'); ?>">
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>

    </div>
<?php } ?>

<?php


function tryvary_include_inline_css()
{
?>
    <style>
        .footer {
            padding: 40px 0;
            background-color: #7a67ff;
            ;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }
        .footer .footer-left p{
            padding-right: 20px;
        }

        .footer-icons {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
        }

        .wp-menu-image img {
            width: 10px !important;
        }

        .footer_p {
            margin: 0;
        }
    </style>
<?php
}



function footer()
{

    echo ('<div class="footer">
  <div class="footer-left"><p class="footer_p">© 
  ');

    echo get_option("copyright");

    echo (' All rights reserved</p></div>
  <div class="footer-center"><p class="footer_p">Contact us: 
  ');

    echo get_option("email");

    echo ('</p>
  </div>
  ');

}



add_action('wp_head', 'tryvary_include_inline_css', 100);



add_action('wp_footer', 'footer');

//add icon to plugin page
function footer_plugin_icon()
{
    ?>
    <style>
        .dashicons-admin-generic:before {
            content: "\f319";
        }
    </style>
<?php }
add_action('admin_head', 'footer_plugin_icon');
