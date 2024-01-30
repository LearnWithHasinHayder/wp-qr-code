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

    private $color = 'ff0000';
    private $size = '150';

    private $position = "content";

    public function __construct() {
        add_action('init', array($this, 'init'));
    }

    public function init() {
        add_filter('the_content', array($this, 'add_qr_code'), 20);
        $this->size = apply_filters('fqc_qr_code_size', $this->size);
        $this->color = apply_filters('fqc_qr_code_color', $this->color);
        $this->position = apply_filters('fqc_qr_code_position', $this->position);
    }

    public function add_qr_code($content) {
        $current_link = esc_url(get_permalink());
        $title = get_the_title();
        if ($this->position == "content") {
            $custom_content = '<div style="border: 1px solid #ddd; padding: 10px; margin: 20px 0;">';
        } else if($this->position == "sticky") {
            $custom_content = '<div style="position: fixed; right:0; bottom:0; border: 1px solid #ddd; padding: 10px; margin: 20px 0; text-align:center;">';
        }
        // $custom_content .= '<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $current_link . '" alt="'.$title.'" />';
        // $custom_content .="<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={$current_link}' alt='{$title}' />";
        $custom_content .= "<img src='https://api.qrserver.com/v1/create-qr-code/?color={$this->color}&size={$this->size}x{$this->size}&data={$current_link}' alt='{$title}' />";
        $custom_content .= '</div>';

        $content .= $custom_content;
        return $content;
    }
}

new FQC_Qr_Code();