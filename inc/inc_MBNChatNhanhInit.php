<?php

class MBNChatNhanhInit
{
    public static function Action()
    {
        add_action('admin_menu', 'MBNChatNhanhInit::menuAdmin');
    }

    public static function menuAdmin()
    {
        add_menu_page(
            'ChatNhanh Settings',
            'ChatNhanh',
            'manage_options',
            'chatnhanh-ettings',
            'MBNChatNhanhInit::pageSetting',
            'dashicons-admin-comments',
            40
        );
    }

    public static function pageSetting()
    {
        if (isset($_POST['chatnhanh'])) {
            if ( 
                ! isset( $_POST['chatnhanh-setting-value'] ) 
                || ! wp_verify_nonce( $_POST['chatnhanh-setting-value'], 'chatnhanh-setting' ) 
            ) {
                echo "<div class=\"notice notice-error\"><p>Thông tin không hợp lệ</p></div>";
            } else {
                if(isset($_POST['chatnhanh']['resetData'])) {
                    update_option("chatnhanh_type", "private");
                    update_option("chatnhanh_type_page", "");
                    update_option("chatnhanh_type_private", "");

                    update_option('chatnhanh_textbutton', "ChatNhanh...");
                    update_option('chatnhanh_backgroubutton', "#4caf50");
                    update_option('chatnhanh_position', "bottom_right");
                    update_option('chatnhanh_script', "footer");

                } else if (isset($_POST['chatnhanh'])) {
                    $chatnhanh_type             = isset($_POST['chatnhanh']['chatnhanh_type'])           
                                                    ? $_POST['chatnhanh']['chatnhanh_type']            
                                                    : 'private';

                    $chatnhanh_type_page        = isset($_POST['chatnhanh']['chatnhanh_type_page'])      
                                                    ? $_POST['chatnhanh']['chatnhanh_type_page']       
                                                    : '';

                    $chatnhanh_type_private     = isset($_POST['chatnhanh']['chatnhanh_type_private'])   
                                                    ? $_POST['chatnhanh']['chatnhanh_type_private']    
                                                    : '';

                    $chatnhanh_textbutton       = isset($_POST['chatnhanh']['chatnhanh_textbutton'])     
                                                    ? $_POST['chatnhanh']['chatnhanh_textbutton']      
                                                    : 'ChatNhanh...';

                    $chatnhanh_backgroubutton   = isset($_POST['chatnhanh']['chatnhanh_backgroubutton']) 
                                                    ? $_POST['chatnhanh']['chatnhanh_backgroubutton']  
                                                    : '#4caf50';

                    $chatnhanh_position         = isset($_POST['chatnhanh']['chatnhanh_position'])       
                                                    ? $_POST['chatnhanh']['chatnhanh_position']        
                                                    : 'bottom_right';

                    $chatnhanh_script           = isset($_POST['chatnhanh']['chatnhanh_script'])         
                                                    ? $_POST['chatnhanh']['chatnhanh_script']          
                                                    : 'footer';

                    
                    update_option("chatnhanh_type", sanitize_text_field( $chatnhanh_type ));
                    update_option("chatnhanh_type_page", sanitize_text_field( $chatnhanh_type_page ));
                    update_option("chatnhanh_type_private", sanitize_text_field( $chatnhanh_type_private ));

                    update_option("chatnhanh_textbutton", sanitize_text_field( $chatnhanh_textbutton ));
                    update_option("chatnhanh_backgroubutton", sanitize_text_field( $chatnhanh_backgroubutton ));
                    update_option("chatnhanh_position", sanitize_text_field( $chatnhanh_position ));
                    update_option("chatnhanh_script", sanitize_text_field( $chatnhanh_script ));
                }

                echo "<div class=\"notice notice-success\"><p>Cập nhật thành công</p></div>"; 
            }
        }

        $chatnhanh_type = get_option('chatnhanh_type');
        $chatnhanh_type_page = get_option('chatnhanh_type_page');
        $chatnhanh_type_private = get_option('chatnhanh_type_private');

        ?>
        <div class="wrap">
            <h1>ChatNhanh setting</h1>

            <form action="" method="post">
               <?php wp_nonce_field( 'chatnhanh-setting', 'chatnhanh-setting-value' ); ?>
                <table class="form-table">

                    <tr>
                        <th>
                            <label for="">Chat type</label>
                        </th>
                        <td>
                            <fieldset>

                                <label for="chatnhanh_type_private">
                                    <input <?php echo $chatnhanh_type == 'private' ? 'checked' : '' ?>
                                            name="chatnhanh[chatnhanh_type]" type="radio" id="chatnhanh_type_private" value="private"
                                           class="regular-text"> Chat với cá nhân
                                </label>
                                <input type="text" name="chatnhanh[chatnhanh_type_private]" id=""
                                       value="<?php echo $chatnhanh_type_private ?>"
                                       class="regular-text" placeholder="Phone number">
                                <br>

                                <label for="chatnhanh_type_page">
                                    <input <?php echo $chatnhanh_type == 'page' ? 'checked' : '' ?>
                                            name="chatnhanh[chatnhanh_type]" type="radio" id="chatnhanh_type_page" value="page"
                                           class="regular-text"> Chat với page
                                </label>

                                <input type="text" name="chatnhanh[chatnhanh_type_page]" id=""
                                       value="<?php echo $chatnhanh_type_page ?>"
                                       class="regular-text" placeholder="Page VIP name">
                            </fieldset>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <label for="">Text button</label>
                        </th>
                        <td>
                            <input name="chatnhanh[chatnhanh_textbutton]" type="text" id="" value="<?php echo get_option('chatnhanh_textbutton', 'ChatNhanh') ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="">Color backgroud button</label>
                        </th>
                        <td>
                            <input name="chatnhanh[chatnhanh_backgroubutton]" type="color" id="" value="<?php echo get_option('chatnhanh_backgroubutton', '#4caf50') ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th><label for="">Position</label></th>
                        <td>
                            <select name="chatnhanh[chatnhanh_position]" id="" class="regular-text">
                                <option <?php echo get_option('chatnhanh_position', 'bottom_right') == "bottom_right" ? 'selected' : '' ?> value="bottom_right">Bottom - right</option>
                                <option <?php echo get_option('chatnhanh_position', 'bottom_right') == "bottom_left" ? 'selected' : '' ?> value="bottom_left">Bottom - left</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="">Position include script</label></th>
                        <td>
                            <select name="chatnhanh[chatnhanh_script]" id="" class="regular-text">
                                <option <?php echo get_option('chatnhanh_script', 'footer') == "footer" ? 'selected' : '' ?>  value="footer">Footer</option>
                                <option <?php echo get_option('chatnhanh_script', 'footer') == "header" ? 'selected' : '' ?>  value="header">Header</option>
                            </select>
                        </td>
                    </tr>


                    <tr>
                        <th></th>
                        <td>
                            <div class="">
                                <button class="button button-primary">Save change</button>

                                <button name="chatnhanh[resetData]" class="button">Restore to Default</button>
                            </div>
                        </td>
                    </tr>
                </table>

            </form>
        </div>

        <?php
    }
}