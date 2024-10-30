<?php
/*
Plugin Name: ChatNhanh
Plugin URI: https://chat.muabannhanh.com/
Description: Tích hợp live chat ChatNhanh
Version: 0.1
Author: MuaBanNhanhCom
Author URI: https://muabannhanh.com
Text Domain: mbn
*/


foreach (glob(__DIR__ . "/inc/inc_*.php") as $filename) {
    include $filename;
}


class MBNChatNhanh
{
    function __construct()
    {
        add_action('init', "MBNChatNhanhInit::Action");
        add_action('init', "MBNChatNhanhFrontend::View");
    }
}

new MBNChatNhanh();