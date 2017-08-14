<?php
/**
 * This File is used for preview likebox purpose.
 *
 * @author Tech Banker
 * @package facebook-likebox/lib
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
}// Exit if accessed directly
if (!is_user_logged_in()) {
    return;
} else {
    $access_granted = false;
    if (isset($user_role_permission) && count($user_role_permission) > 0) {
        foreach ($user_role_permission as $permission) {
            if (current_user_can($permission)) {
                $access_granted = true;
                break;
            }
        }
    }
    if (!$access_granted) {
        return;
    } else {

        function facebook_likebox_preview_data($meta_id) {
            global $wpdb;
            $likebox_all_data = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . facebook_meta_table() .
                            " WHERE meta_id = %d", $meta_id
                    )
            );
            return unserialize($likebox_all_data);
        }

        if (isset($_REQUEST["param"])) {
            switch (esc_attr($_REQUEST["param"])) {
                case "facebook_likebox_preview" :
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_likebox_preview_nonce")) {
                        $meta_id = isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0;
                        if ($meta_id != 0) {
                            $likebox_data = facebook_likebox_preview_data($meta_id);
                            $source = "";
                            if (esc_attr($likebox_data["likebox_source_type"]) == "page_url") {
                                $source = esc_attr($likebox_data["page_url"]);
                            } else {
                                $source = "https://www.facebook.com/" . esc_attr($likebox_data["page_id"]);
                            }
                        } else {
                            parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $like_box_data_array);
                            $likebox_data = array();
                            $likebox_data["likebox_source_type"] = esc_attr($like_box_data_array["ux_ddl_fb_likebox_source"]);
                            $likebox_data["page_url"] = esc_attr($like_box_data_array["ux_txt_likebox_page_url"]);
                            $likebox_data["page_id"] = esc_attr($like_box_data_array["ux_txt_likebox_page_id"]);
                            $likebox_data["title"] = esc_attr($like_box_data_array["ux_txt_likebox_title"]);
                            $likebox_data["language"] = esc_attr($like_box_data_array["ux_ddl_likebox_language"]);
                            $likebox_data["width"] = intval($like_box_data_array["ux_txt_likebox_width"]);
                            $likebox_data["height"] = intval($like_box_data_array["ux_txt_likebox_height"]);
                            $likebox_data["header"] = esc_attr($like_box_data_array["ux_ddl_likebox_header"]);
                            $likebox_data["post_stream"] = esc_attr($like_box_data_array["ux_ddl_likebox_stream"]);
                            $likebox_data["events"] = esc_attr($like_box_data_array["ux_ddl_likebox_events"]);
                            $likebox_data["messages"] = esc_attr($like_box_data_array["ux_ddl_likebox_messages"]);
                            $likebox_data["cover_photo"] = esc_attr($like_box_data_array["ux_ddl_likebox_cover_photo"]);
                            $likebox_data["animation_effect"] = esc_attr($like_box_data_array["ux_ddl_likebox_animations_effects"]);
                            $likebox_data["border_style"] = esc_attr(implode(",", $like_box_data_array["ux_ddl_likebox_border_style"]));
                            $likebox_data["border_radius"] = "0";
                            $likebox_data["show_user_faces"] = esc_attr($like_box_data_array["ux_ddl_likebox_user_faces"]);
                            $source = "";
                            if (esc_attr($likebox_data["likebox_source_type"]) == "page_url") {
                                $source = esc_attr($likebox_data["page_url"]);
                            } else {
                                $source = "https://www.facebook.com/" . esc_attr($likebox_data["page_id"]);
                            }
                        }
                        ?>
                        <style>
                            .like-box
                            {
                                width: <?php echo $likebox_data["width"]; ?>px;
                                height: <?php echo $likebox_data["height"]; ?>px;
                                border: 1px none #000000 !important;
                                border-radius: 0px;
                                overflow: hidden;
                            }
                        </style>
                        <?php
                        $url = urlencode($source);
                        $post_stream = $likebox_data["post_stream"];
                        $events = $likebox_data["events"];
                        $messages = $likebox_data["messages"];
                        $likebox_src = "https://www.facebook.com/plugins/page.php?href=";
                        $likebox_src .= $url;
                        $likebox_src .= "&tabs=$post_stream,$events,$messages";
                        $likebox_src .= "&width=" . $likebox_data["width"];
                        $likebox_src .= "&height=" . $likebox_data["height"];
                        $likebox_src .= "&small_header=" . $likebox_data['header'];
                        $likebox_src .= "&adapt_container_width=true";
                        $likebox_src .= "&hide_cover=" . $likebox_data["cover_photo"];
                        $likebox_src .= "&locale=" . $likebox_data["language"];
                        $likebox_src .= "&show_facepile=" . $likebox_data["show_user_faces"];
                        $facebook_likebox_iframe = '<iframe src=' . $likebox_src . ' class="like-box fbl_animation_time ' . $likebox_data["animation_effect"] . '"></iframe>';
                        echo $facebook_likebox_iframe;
                    }
                    break;

                case "facebook_likebutton_preview" :
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_likebutton_preview_nonce")) {
                        $meta_id = isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0;
                        if ($meta_id != 0) {
                            $like_button_data = facebook_likebox_preview_data($meta_id);
                            $source = "";
                            if (esc_attr($like_button_data["likebox_source_type"]) == "page_url") {
                                $source = esc_attr($like_button_data["page_url"]);
                            } else {
                                $source = "https://www.facebook.com/" . esc_attr($like_button_data["page_id"]);
                            }
                        } else {
                            parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $like_button_data_array);
                            $like_button_data = array();
                            $like_button_data["button_type"] = esc_attr($like_button_data_array["ux_ddl_fb_button_type"]);
                            $like_button_data["likebox_source_type"] = esc_attr($like_button_data_array["ux_ddl_fb_likebox_source"]);
                            $like_button_data["page_url"] = esc_attr($like_button_data_array["ux_txt_like_button_page_url"]);
                            $like_button_data["page_id"] = esc_attr($like_button_data_array["ux_txt_like_button_page_id"]);
                            $like_button_data["title"] = esc_attr($like_button_data_array["ux_txt_like_button_title"]);
                            $like_button_data["language"] = esc_attr($like_button_data_array["ux_ddl_like_button_language"]);
                            $like_button_data["action"] = esc_attr($like_button_data_array["ux_ddl_like_button_action"]);
                            $like_button_data["width"] = intval($like_button_data_array["ux_txt_like_button_width"]);
                            $like_button_data["button_style"] = esc_attr($like_button_data_array["ux_ddl_like_button_style"]);
                            $like_button_data["button_size"] = esc_attr($like_button_data_array["ux_ddl_like_button_size"]);
                            $like_button_data["share_button"] = esc_attr($like_button_data_array["ux_ddl_like_button_share_button"]);
                            $source = "";
                            if (esc_attr($like_button_data["likebox_source_type"]) == "page_url") {
                                $source = esc_attr($like_button_data["page_url"]);
                            } else {
                                $source = "https://www.facebook.com/" . esc_attr($like_button_data["page_id"]);
                            }
                        }
                        $button_source = "";
                        switch (esc_attr($like_button_data["button_type"])) {
                            case "like":
                                $button_source = "like";
                                break;
                            case "share":
                                $button_source = "share_button";
                                break;
                            case "follow":
                                $button_source = "follow";
                                break;
                        }
                        ?>
                        <style>
                            .like-button
                            {
                                width: <?php echo $like_button_data["width"]; ?>px;
                                overflow: hidden;
                                padding: 5px;
                            }
                        </style>
                        <?php
                        $url = urlencode($source);
                        $like_button_src = "https://www.facebook.com/plugins/$button_source.php?href=";
                        $like_button_src .= $url;
                        $like_button_src .= "&width=" . $like_button_data["width"];
                        $like_button_src .= "&layout=" . $like_button_data["button_style"];
                        $like_button_src .= "&action=" . $like_button_data["action"];
                        $like_button_src .= "&size=" . $like_button_data["button_size"];
                        $like_button_src .= "&share=" . $like_button_data["share_button"];
                        $like_button_src .= "&locale=" . $like_button_data["language"];
                        $facebook_like_button = '<iframe src=' . $like_button_src . ' class="like-button" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
                        echo $facebook_like_button;
                    }
                    break;

                case "facebook_likebox_button_preview" :
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "fbl_likebox_button_nonce")) {
                        $meta_id = isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0;
                        if ($meta_id != 0) {
                            $likebox_and_button_data = facebook_likebox_preview_data($meta_id);
                            $source = "";
                            if (esc_attr($likebox_and_button_data["likebox_source_type"]) == "page_url") {
                                $source = esc_attr($likebox_and_button_data["page_url"]);
                            } else {
                                $source = "https://www.facebook.com/" . esc_attr($likebox_and_button_data["page_id"]);
                            }
                        } else {
                            parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $likebox_button_data_array);
                            $likebox_and_button_data = array();
                            $likebox_and_button_data["likebox_source_type"] = esc_attr($likebox_button_data_array["ux_ddl_fb_likebox_source"]);
                            $likebox_and_button_data["page_url"] = esc_attr($likebox_button_data_array["ux_txt_likebox_and_button_page_url"]);
                            $likebox_and_button_data["page_id"] = esc_attr($likebox_button_data_array["ux_txt_likebox_and_button_page_id"]);
                            $likebox_and_button_data["title"] = esc_attr($likebox_button_data_array["ux_txt_likebox_and_button_title"]);
                            $likebox_and_button_data["language"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_likebutton_language"]);
                            $likebox_and_button_data["width"] = intval($likebox_button_data_array["ux_txt_likebox_and_button_width"]);
                            $likebox_and_button_data["height"] = intval($likebox_button_data_array["ux_txt_likebox_and_button_height"]);
                            $likebox_and_button_data["header"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_header"]);
                            $likebox_and_button_data["post_stream"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_post"]);
                            $likebox_and_button_data["cover_photo"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_cover_photo"]);
                            $likebox_and_button_data["border_style"] = esc_attr(implode(",", $likebox_button_data_array["ux_txt_border_style"]));
                            $likebox_and_button_data["border_radius"] = "0";
                            $likebox_and_button_data["show_user_faces"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_show_faces"]);
                            $likebox_and_button_data["events"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_events"]);
                            $likebox_and_button_data["messages"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_messages"]);
                            $likebox_and_button_data["button_type"] = esc_attr($likebox_button_data_array["ux_ddl_fb_button_type"]);
                            $likebox_and_button_data["button_style"] = esc_attr($likebox_button_data_array["ux_ddl_like_button_style"]);
                            $likebox_and_button_data["button_size"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_and_button_size"]);
                            $likebox_and_button_data["action"] = esc_attr($likebox_button_data_array["ux_ddl_like_box_button_action"]);
                            $likebox_and_button_data["share_button"] = esc_attr($likebox_button_data_array["ux_ddl_like_button_box_share_button"]);
                            $likebox_and_button_data["animation_effect"] = esc_attr($likebox_button_data_array["ux_ddl_likebox_button_animations_effects"]);
                            $source = "";
                            if (esc_attr($likebox_and_button_data["likebox_source_type"]) == "page_url") {
                                $source = esc_attr($likebox_and_button_data["page_url"]);
                            } else {
                                $source = "https://www.facebook.com/" . esc_attr($likebox_and_button_data["page_id"]);
                            }
                        }
                        $button_source = "";
                        switch (esc_attr($likebox_and_button_data["button_type"])) {
                            case "like":
                                $button_source = "like";
                                break;
                            case "share":
                                $button_source = "share_button";
                                break;
                            case "follow":
                                $button_source = "follow";
                                break;
                        }
                        ?>
                        <style>
                            .like-box-button
                            {
                                max-width: <?php echo $likebox_and_button_data["width"]; ?>px;
                                border-radius: 0px !important;
                                border: 1px none #000000 !important;
                                overflow: hidden !important;
                            }
                            .like-box
                            {
                                width: <?php echo $likebox_and_button_data["width"]; ?>px;
                                height: <?php echo $likebox_and_button_data["height"]; ?>px;
                            }
                            .like-button
                            {
                                width: <?php echo $likebox_and_button_data["width"]; ?>px;
                            }
                            <?php
                            if ($likebox_and_button_data["button_size"] == "large" && $likebox_and_button_data["button_style"] == "box_count") {
                                ?>
                                .like-button-div
                                {
                                    height: 90px;
                                    padding: 5px;
                                }
                                <?php
                            } else {
                                ?>
                                .like-button-div
                                {
                                    height: 60px;
                                    padding: 5px;
                                }
                                <?php
                            }
                            ?>
                        </style>
                        <?php
                        $url = urlencode($source);
                        $post_stream = $likebox_and_button_data["post_stream"];
                        $events = $likebox_and_button_data["events"];
                        $messages = $likebox_and_button_data["messages"];
                        $likebox_src = "https://www.facebook.com/plugins/page.php?href=";
                        $likebox_src .= $url;
                        $likebox_src .= "&tabs=$post_stream,$events,$messages";
                        $likebox_src .= "&width=" . $likebox_and_button_data["width"];
                        $likebox_src .= "&height=" . $likebox_and_button_data["height"];
                        $likebox_src .= "&small_header=" . $likebox_and_button_data['header'];
                        $likebox_src .= "&adapt_container_width=true";
                        $likebox_src .= "&hide_cover=" . $likebox_and_button_data["cover_photo"];
                        $likebox_src .= "&locale=" . $likebox_and_button_data["language"];
                        $likebox_src .= "&show_facepile=" . $likebox_and_button_data["show_user_faces"];
                        $like_button_src = "https://www.facebook.com/plugins/$button_source.php?href=";
                        $like_button_src .= $url;
                        $like_button_src .= "&width=" . $likebox_and_button_data["width"];
                        $like_button_src .= "&layout=" . $likebox_and_button_data["button_style"];
                        $like_button_src .= "&size=" . $likebox_and_button_data["button_size"];
                        $like_button_src .= "&locale=" . $likebox_and_button_data["language"];
                        $like_button_src .= "&action=" . $likebox_and_button_data["action"];
                        $like_button_src .= "&share=" . $likebox_and_button_data["share_button"];
                        $facebook_likebox_button = '<div class="like-box-button fbl_animation_time ' . $likebox_and_button_data["animation_effect"] . '"><iframe src=' . $likebox_src . ' class="like-box" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
                        $facebook_likebox_button .= '<div class="like-button-div"><iframe src=' . $like_button_src . ' class="like-button" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div></div>';
                        echo $facebook_likebox_button;
                    }
                    break;
            }
            die();
        }
    }
}