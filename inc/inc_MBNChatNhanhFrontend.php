<?php

class MBNChatNhanhFrontend
{
    public static function View()
    {

        $positionScript = get_option('chatnhanh_script', 'footer');

        if ($positionScript == 'footer') {
            $positionScript = 'wp_footer';
        } else {
            $positionScript = 'wp_head';
        }

        add_action($positionScript, "MBNChatNhanhFrontend::includeScript");
        add_action('wp_footer', "MBNChatNhanhFrontend::footer");
    }

    public static function footer()
    {
        echo "<div class='widget-chat-nhanh'></div>";
    }
    public static function includeScript()
    {
        $type = get_option('chatnhanh_type', 'private');
        $phone = get_option('chatnhanh_type_private', '');
        $page = get_option('chatnhanh_type_page', '');
        $textButton = get_option('chatnhanh_textbutton', "ChatNhanh...");
        $bgButton = get_option('chatnhanh_backgroubutton', "#4caf50");
        $position = get_option('chatnhanh_position', "bottom_right");

        $url = "https://vip.muabannhanh.com/chatnhanh/chatnhanh.php?";
        $url .= http_build_query(array(
            "type" => $type,
            "page" => $page,
            "phone" => $phone,
            "button_text" => $textButton,
            "button_bg" => $bgButton,
            "position" => $position,
            "from" => get_home_url()
        ));
        echo "<script type=\"text/javascript\" src=\"{$url}\"></script>";
    }
}