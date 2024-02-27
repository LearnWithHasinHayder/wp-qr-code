<?php
/**
 * Plugin Name: Fantastic QR Code
 * Description: Display a QR code for the current page
 * Version: 1.0.0
 * Author: Hasin Hayder
 * Author URI: http://hasin.me
 * Plugin URI: http://google.com
 */

class FQC_Qr_Code {
    public function __construct() {
        add_action('init', array($this, 'init'));
    }

    public function init() {
        add_filter('the_content', array($this, 'add_qr_code'));

        require_once plugin_dir_path(__FILE__) . 'metabox.php';

        new Metabox();

        require_once plugin_dir_path(__FILE__) . 'metabox-io.php';

        new Metabox_IO();
    }

    public function add_qr_code($content) {
        $current_link = esc_url(get_permalink());
        $title = get_the_title();
        $custom_content = '<div style="border: 1px solid #ddd; padding: 10px; margin: 20px 0;">';
        // $custom_content .= '<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $current_link . '" alt="'.$title.'" />';
        // $custom_content .="<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={$current_link}' alt='{$title}' />";
        $custom_content .="<img src='https://api.qrserver.com/v1/create-qr-code/?color=ff0000&size=150x150&data={$current_link}' alt='{$title}' />";
        $custom_content .= '</div>';
        
        $content .= $custom_content;
        return $content;
    }
}

new FQC_Qr_Code();