<?php

/**
 * This File is used for managing database of Frontend.
 *
 * @author Tech Banker
 * @package facebook-likebox/user-views/lib
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} //exit if accessed directly
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

        function get_facebook_likebox_shortcode_data($type) {
            global $wpdb;
            $facebook_likebox_data = array();
            $data = $wpdb->get_results
                    (
                    $wpdb->prepare
                            (
                            "SELECT * FROM " . facebook_meta_table() . " WHERE meta_key = %s ORDER BY id DESC", $type
                    )
            );
            foreach ($data as $row) {
                $record = unserialize($row->meta_value);
                $record["meta_id"] = intval($row->meta_id);
                array_push($facebook_likebox_data, $record);
            }
            return $facebook_likebox_data;
        }

        if (isset($_REQUEST["param"])) {
            switch (esc_attr($_REQUEST["param"])) {
                case "facebook_likebox_widget_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_likebox_widget_nonce")) {
                        $likebox_type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "add_like_box_settings";
                        $likebox_data = get_facebook_likebox_shortcode_data($likebox_type);
                        $title_data = "";
                        foreach ($likebox_data as $val) {
                            $title_data .= "<option value=" . intval($val["meta_id"]) . ">" . esc_attr($val["title"]) . "</option>";
                        }
                        echo $title_data;
                    }
                    break;

                case "facebook_like_button_widget_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_like_button_widget_nonce")) {
                        $likebox_type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "add_like_button_settings";
                        $likebox_data = get_facebook_likebox_shortcode_data($likebox_type);
                        $title_data = "";
                        foreach ($likebox_data as $val) {
                            $title_data .= "<option value=" . intval($val["meta_id"]) . ">" . esc_attr($val["title"]) . "</option>";
                        }
                        echo $title_data;
                    }
                    break;

                case "facebook_like_box_button_widget_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_like_box_button_widget_nonce")) {
                        $likebox_type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "like_box_and_button_settings";
                        $likebox_data = get_facebook_likebox_shortcode_data($likebox_type);
                        $title_data = "";
                        foreach ($likebox_data as $val) {
                            $title_data .= "<option value=" . intval($val["meta_id"]) . ">" . esc_attr($val["title"]) . "</option>";
                        }
                        echo $title_data;
                    }
                    break;

                case "facebook_likebox_shortcode_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_likebox_shortcode_nonce")) {
                        $likebox_type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "add_like_box_settings";
                        $received_likebox_data = get_facebook_likebox_shortcode_data($likebox_type);
                        $option = "<option value = ''>$fbl_select_title</option>";
                        foreach ($received_likebox_data as $val) {
                            $source = $val["likebox_source_type"] == "page_url" ? esc_attr($val["page_url"]) : esc_attr($val["page_id"]);
                            $option .= "<option value =" . intval($val["meta_id"]) . ">" . esc_attr($val["title"]) . " ( " . $source . " ) " . "</option>";
                        }
                        echo $option;
                    }
                    break;
            }
            die();
        }
    }
}